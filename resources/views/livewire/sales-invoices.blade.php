<div class="py-12">
    <div class="container mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    @if (session()->has('message'))
                    @endif
                    <div class="flex items-end justify-between mb-4">
                        <div class="w-1/3 space-y-1">
                            <x-jet-input id="search" class="block w-full mt-1 " type="text" inputmode="numeric"
                                placeholder="Search for ..." wire:model="search" name="search" />
                        </div>
                        <div class="space-y-1">
                            <x-jet-label for="perPage" value="{{ __('Per page') }}" />

                            <select id="perPage"
                                class="block w-24 mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="number" inputmode="numeric" wire:model="perPage" name="perPage" />
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4 overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <x-table.row>
                                    <x-table.heading sortable wire:click="sortBy('item')"
                                        :direction="$sorts['item'] ?? null">Item</x-table.heading>
                                    <x-table.heading sortable wire:click="sortBy('warehouse')"
                                        :direction="$sorts['warehouse'] ?? null">Warehouse</x-table.heading>
                                    <x-table.heading sortable wire:click="sortBy('price')"
                                        :direction="$sorts['price'] ?? null">Price</x-table.heading>
                                    <x-table.heading sortable wire:click="sortBy('quantity')"
                                        :direction="$sorts['quantity'] ?? null">Quantity</x-table.heading>
                                   
                                    <th scope="col" class="relative px-6 py-3 text-right">
                                        <button class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-900"
                                            wire:click="toggleAddingModal">Purchase Invoice</button>
                                    </th>
                                </x-table.row>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                                {{-- @foreach ($purchasements as $purchase) --}}
                                {{-- <tr :wire:key="$purchase->id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $purchase->vendor->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $purchase->total_cost }}</div>
                                    </td>
                                    <td class="px-6 py-4 space-x-4 text-sm font-medium text-right whitespace-nowrap">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900"
                                            wire:click="update({{ $purchase }})">Edit</a>
                                        <a href="#" class="text-red-600 hover:text-red-900"
                                            wire:click="confirmingDeletion({{ $purchase }})">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> --}}
                    {{-- {{ $purchasements->links() }} --}}
                </div>
            </div>
            <form method="post" wire:submit.prevent="destroy()">
                <x-jet-confirmation-modal wire:model="isDeleting">
                    <x-slot name="title">
                        Are you sure you want to delete
                        <strong>{{ optional($InvoiceToDelete ?? '')['name'] }}</strong>
                    </x-slot>
                    <x-slot name="content">
                    </x-slot>
                    <x-slot name="footer">
                        <button class="px-6 py-2 text-white bg-red-600 rounded hover:bg-red-900" type="submit">Delete
                            Purchase Invoice</button>
                        <button class="px-6 py-2 text-gray-600 rounded" wire:click="$set('isDeleting', false)"
                            type="button">Cancel</button>
                    </x-slot>
                </x-jet-confirmation-modal>
            </form>
            <!-- End Delete Model -->


            <!-- Customer Modal Form -->
            <form wire:submit.prevent="store()" method="post">
                <x-jet-dialog-modal max-width="2xl" wire:model="isAddingNewItem" class="w-1/2">
                    <div class="mb-6">

                        <x-slot name="title">
                            Purchase Invoice
                        </x-slot>

                    </div>
                    <div class="mb-6">
                    <x-slot name="content">
                        
                            <x-jet-validation-errors></x-jet-validation-errors>
                    </div>
                            <div class="mb-6">

                                <livewire:search-dropdown/>
                            </div>

                            {{-- <div class="mt-4 space-y-1">
                                <x-jet-label for="vendor" value="{{ __('Vendor') }}" />
                                <x-jet-input id="vendor" class="block w-full mt-1" type="text" inputmode="numeric"
                                    wire:model="invoice.vendor" name="name" autofocus />
                            </div> --}}

                            {{-- @foreach ($invoiceItems as $index => $item)
                            <div>
                                <div class="flex mt-4 mb-6 space-x-2">
                                    <div class="w-1/4">
                                        <x-jet-label for="Item" value="{{ __('Item') }}" />
                                        <x-input.select aria-label="Default select example" class="block w-full mt-1"
                                            wire:model="invoiceItems.{{ $index }}.item_id">
                                            <option value=""></option>
                                            @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                            @endforeach
                                        </x-input.select>
                                    </div>
                                    <div class="w-1/4">
                                        <x-jet-label for="cost" value="{{ __('Warehouse') }}" />
                                        <x-input.select class="block w-full mt-1"
                                            wire:model="invoiceItems.{{ $index }}.warehouse">
                                            <option value=""></option>
                                            @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">
                                                {{ $warehouse->title }}
                                            </option>
                                            @endforeach
                                        </x-input.select>
                                    </div>
                                    <div class="w-1/4">
                                        <x-jet-label for="quantity" value="{{ __('Quantity') }}" />
                                        <x-jet-input id="quantity" class="block w-full mt-1" type="text"
                                            inputmode="numeric" wire:model="invoiceItems.{{ $index }}.quantity"
                                            name="address" />
                                    </div>
                                    <div class="w-1/4">
                                        <x-jet-label for="cost" value="{{ __('Cost') }}" />
                                        <x-jet-input id="cost" class="block w-full mt-1" type="number"
                                            inputmode="numeric" wire:model="invoiceItems.{{ $index }}.cost"
                                            name="cost" />
                                    </div>
                                </div>
                            </div>
                            @endforeach --}}
                            <div class="mt-2 text-right">
                                <x-button.primary>
                                    <x-feathericon-plus-circle class="inline-block p-4 m" />
                                    New Item
                                </x-button.primary>
                            </div>
                            <div class="mt-12 space-y-1">
                                <x-jet-label for="date" value="{{ __('Date') }}" />
                                <x-jet-input id="date" class="block w-full mt-1" type="date" wire:model="invoice.date"
                                    name="date" />
                            </div>
                    </x-slot>
                    <x-slot name="footer">
                        <x-button.primary>Save</x-button.primary>
                        <button class="px-6 py-2 text-gray-600 rounded" wire:click="toggleAddingModal()"
                            type="button">Cancel</button>
                    </x-slot>
                </x-jet-dialog-modal>
            </form>
        </div>
    </div>
</div>