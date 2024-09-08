<x-master>
  <x-decor.sidelog/>

    <div class="w-full bg-white shadow-2xl flex flex-col justify-center items-center">
      <form class="w-[32vw]">
        <h1 class="text-3xl font-semibold mb-6">Welcome back!</h1>
        <x-input type="email" name="email" id="email" label="Email address" />
        <x-input type="password" name="password" id="password" label="Password" />
        <button type="submit"
          class="text-white bg-primary hover:bg-secondary font-medium rounded-2xl w-full text-md px-5 py-3 text-center mb-5">Login</button>
        <p class="text-center text-gray-500">Don't have an account? <a href="/" class="underline text-blue-500">Register here</a></p>
      </form>
    </div>
  </div>

</x-master>
