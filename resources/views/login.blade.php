<x-master>
  <x-decor.sidelog/>

    <div class="w-full bg-white shadow-2xl flex flex-col justify-center items-center">
      <form class="w-[32vw]"action="/auth" method="POST">
        @csrf
        <h1 class="text-3xl font-semibold mb-6">Welcome back!</h1>
        <x-input type="username" name="username" id="username" label="Username" />
        @if ($errors->has('username'))
            <p class="text-red-500 text-sm mb-2">{{ $errors->first('username') }}</p>
        @endif

        <x-input type="password" name="password" id="password" label="Password" />
        @if ($errors->has('password'))
            <p class="text-red-500 text-sm mb-2">{{ $errors->first('password') }}</p>
        @endif

        <button type="submit"
          class="text-white bg-primary hover:bg-secondary font-medium rounded-2xl w-full text-md px-5 py-3 text-center mb-5">Login</button>
        <p class="text-center text-gray-500">Don't have an account? <a href="/" class="underline text-blue-500">Register here</a></p>
      </form>
    </div>
  </div>

</x-master>
