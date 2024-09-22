<li>
  <a href="{{ $href }}"
  class="flex items-center p-2 rounded-lg group hover:bg-secondary {{ request()->is(trim(parse_url($href, PHP_URL_PATH), '/')) ? 'bg-secondary text-white' : 'bg-primary text-white' }}">
    {{ $slot }}
    <span class="ms-3">{{ $linkName }}</span>
  </a>
</li>
