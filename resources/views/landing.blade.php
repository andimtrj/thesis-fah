<x-master>
  <nav class="flex justify-center">
    <div class="flex justify-between py-5 px-5 border-b-2 w-2/3 relative z-10">
      <div>
        <h1 class="text-4xl">LOGO</h1>
      </div>
      <div>
        <a href="{{ route('register') }}"
          class="flex border-primary border-opacity-20 border-2 px-7 py-2 rounded-lg font-medium drop-shadow-xl">Sign
          Up</a>
      </div>
    </div>
  </nav>

  <div class="flex flex-col justify-center pt-24 text-center relative z-10 mb-20">
    <h1 class="text-6xl">Optimize Inventory, Maximize Efficiency</h1>
    <h4 class="px-[30vw] pt-4">Take control of your restaurant inventory with our easy-to-use web-based app! Track stock,
      reduce waste, and boost efficiency today!</h4>
  </div>

  <div class="flex justify-center items-center gap-10 text-lg">
    <div class="w-72 h-72 flex justify-center items-center bg-cream shadow-2xl rounded-2xl px-4 py-2">
      <h1>Save time on manual recording and stock monitoring.</h1>
    </div>
    <div class="w-96 h-96 flex justify-center items-center bg-cream shadow-2xl rounded-2xl px-4 py-2">
      <h1>Monitor stock accurately and in real-time from anywhere. </h1>
    </div>
    <div class="w-72 h-72 flex justify-center items-center bg-cream shadow-2xl rounded-2xl px-4 py-2">
      <h1>Reduce errors in stock calculations with automation.</h1>
    </div>
  </div>
  

  <!-- Background SVG -->
  <div class="absolute inset-x-0 bottom-0 -z-10">
    <svg id="wave" style="transform:rotate(0deg); transition: 0.3s" viewBox="0 0 1440 420" version="1.1"
      xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">
          <stop stop-color="rgba(0, 48, 73, 1)" offset="0%"></stop>
          <stop stop-color="rgba(26, 77, 124, 1)" offset="100%"></stop>
        </linearGradient>
      </defs>
      <path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)"
        d="M0,252L60,224C120,196,240,140,360,147C480,154,600,224,720,224C840,224,960,154,1080,119C1200,84,1320,84,1440,105C1560,126,1680,168,1800,175C1920,182,2040,154,2160,182C2280,210,2400,294,2520,273C2640,252,2760,126,2880,63C3000,0,3120,0,3240,63C3360,126,3480,252,3600,252C3720,252,3840,126,3960,63C4080,0,4200,0,4320,7C4440,14,4560,28,4680,91C4800,154,4920,266,5040,287C5160,308,5280,238,5400,224C5520,210,5640,252,5760,231C5880,210,6000,126,6120,91C6240,56,6360,70,6480,84C6600,98,6720,112,6840,133C6960,154,7080,182,7200,175C7320,168,7440,126,7560,98C7680,70,7800,56,7920,91C8040,126,8160,210,8280,252C8400,294,8520,294,8580,294L8640,294L8640,420L8580,420C8520,420,8400,420,8280,420C8160,420,8040,420,7920,420C7800,420,7680,420,7560,420C7440,420,7320,420,7200,420C7080,420,6960,420,6840,420C6720,420,6600,420,6480,420C6360,420,6240,420,6120,420C6000,420,5880,420,5760,420C5640,420,5520,420,5400,420C5280,420,5160,420,5040,420C4920,420,4800,420,4680,420C4560,420,4440,420,4320,420C4200,420,4080,420,3960,420C3840,420,3720,420,3600,420C3480,420,3360,420,3240,420C3120,420,3000,420,2880,420C2760,420,2640,420,2520,420C2400,420,2280,420,2160,420C2040,420,1920,420,1800,420C1680,420,1560,420,1440,420C1320,420,1200,420,1080,420C960,420,840,420,720,420C600,420,480,420,360,420C240,420,120,420,60,420L0,420Z">
      </path>
    </svg>
  </div>

</x-master>
