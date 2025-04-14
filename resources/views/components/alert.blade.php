@props(['type' => 'success', 'message'])

@if($message)
    <div x-data="{ show: true }" 
         x-show="show" 
         x-init="setTimeout(() => show = false, 5000)"
         class="fixed top-4 right-4 z-50 rounded-md p-4 max-w-md"
         :class="{
             'bg-green-50 text-green-800 border border-green-200': type === 'success',
             'bg-red-50 text-red-800 border border-red-200': type === 'error',
             'bg-yellow-50 text-yellow-800 border border-yellow-200': type === 'warning'
         }">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                @if($type === 'success')
                    <i class="fas fa-check-circle text-green-400"></i>
                @elseif($type === 'error')
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                @else
                    <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                @endif
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">{{ $message }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button @click="show = false" class="inline-flex rounded-md p-1.5 focus:outline-none">
                        <span class="sr-only">Dismiss</span>
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif 