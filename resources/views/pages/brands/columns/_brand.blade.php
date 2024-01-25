<!--begin:: Avatar -->
<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
    <a href="{{ route('user-management.users.show', $brand) }}">
        @if($brand->avatar)
            <div class="symbol-label">
                <img src="{{ Storage::url($brand->avatar) }}" class="w-100"/>
            </div>
        @else
            <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', $brand->name) }}">
                {{ substr($brand->name, 0, 1) }}
            </div>
        @endif
    </a>
</div>
<!--end::Avatar-->

