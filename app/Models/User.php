<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Role;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'email_verified_at',
        'phone_number',
        'first_name',
        'last_name',
        'role_id',
        'tenant_id',
        'branch_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function GetUserById(Request $request){
        $validator = Validator::make($request->all(), [
            'userId' => 'required|integer|exists:users,id'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        return User::find($request->userId);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public static function GetPagingBranchAdmin($request, $branchId){
        $authTenantId = Auth::user()->tenant_id;

        if ($authTenantId | $branchId) {
            $query = User::join('branches as b', 'users.branch_id', '=', 'b.id')
                        ->join('roles as r', 'users.role_id', '=', 'r.id')
                        ->where('b.id', '=', $branchId)
                        ->where('r.role_code', '=', 'BA');
            if($request->input('name')){
                $query = $query->where('users.first_name', 'like', '%' . $request->input('name') . '%');
                $query = $query->orWhere('users.last_name', 'like', '%' . $request->input('name') . '%');
            }

            if($request->input('username')){
                $query = $query->where('users.username', 'like', '%' . $request->input('username') . '%');
            }
            // Apply filters if branchCode or branchName is provided
            $user = $query->select(
                                        'users.id',
                                        DB::raw("CONCAT(users.first_name, ' ', users.last_name) as name"),
                                        'users.username',
                                        'users.email'
                                    )
                                ->orderBy('users.username')
                                ->paginate(10);

        } else {
            abort(500, "Invalid Tenant");
        }
        return $user;


    }

}
