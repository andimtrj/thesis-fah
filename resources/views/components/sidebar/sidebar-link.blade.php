<li>
  <a href="{{ $href }}"
  class="flex items-center p-2 rounded-lg group hover:bg-primary {{ request()->is(trim(parse_url($href, PHP_URL_PATH), '/')) ? 'bg-primary text-white' : 'bg-none text-white' }}">
    {{ $slot }}
    <span class="ms-3">{{ $linkName }}</span>
  </a>
</li>
