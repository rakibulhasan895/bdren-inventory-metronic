<!--begin:: Avatar -->
<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
    <a href="{{ route('user-management.users.show', $product) }}">
        @if($product->avatar)
            <div class="symbol-label">
                <img src="{{ Storage::url($product->avatar) }}" class="w-100"/>
            </div>
        @else
            <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', $product->name) }}">
                {{ substr($product->name, 0, 1) }}
            </div>
        @endif
    </a>
</div>
<!--end::Avatar-->

