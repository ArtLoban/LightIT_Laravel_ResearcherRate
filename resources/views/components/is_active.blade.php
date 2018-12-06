{{-- Add class='active' if matches url --}}
{{ request()->is($url) ? 'active' : '' }}
{{--{{ request()->is('admin/profiles') ? 'active' : '' }}--}}
