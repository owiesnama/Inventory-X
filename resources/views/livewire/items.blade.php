<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            @if (session()->has('message'))
            @endif
            <div class="flex items-end justify-between mb-4">
                <div class="w-1/3 space-y-1">
                    <x-jet-input id="search" class="block w-full mt-1 " type="text" inputmode="numeric"
                        placeholder="Item to search for ..." wire:model="search" name="search" />
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
                        <tr>
                            <x-table.heading sortable wire:click="sortBy('name')" :direction="$sorts['name'] ?? null">
                                Name</x-table.heading>
                            <x-table.heading sortable wire:click="sortBy('price')" :direction="$sorts['price'] ?? null">
                                Price</x-table.heading>
                            <x-table.heading sortable wire:click="sortBy('cost')" :direction="$sorts['cost'] ?? null">
                                Cost</x-table.heading>
                            <x-table.heading>Status</x-table.heading>
                            <th scope="col" class="relative px-6 py-3 text-right">
                                <button class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-900"
                                    wire:click="create">New
                                    Item</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($items as $item)
                            <tr wire:key="item-{{ $item->id }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $item->description }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->price }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $item->cost }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                        Available </span>
                                </td>
                                <td class="px-6 py-4 space-x-4 text-sm font-medium text-right whitespace-nowrap">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900"
                                        wire:click="edit({{ $item }})">Edit</a>
                                    <a href="#" class="text-red-600 hover:text-red-900"
                                        wire:click="delete({{ $item }})">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $items->links() }}
        </div>
    </div>

    <form method="post" wire:submit.prevent="destroy()">
        <x-jet-confirmation-modal wire:model="deleting">
            <x-slot name="title">
                Are you sure you want to delete <strong>{{ optional($deleting)->name }}</strong>
            </x-slot>
            <x-slot name="content">
            </x-slot>
            <x-slot name="footer">
                <button class="px-6 py-2 text-white bg-red-600 rounded hover:bg-red-900" type="submit">Delete
                    Item</button>
                <button class="px-6 py-2 text-gray-600 rounded" wire:click="$set('deleting', null)"
                    type="button">Cancel</button>
            </x-slot>
        </x-jet-confirmation-modal>
    </form>

    <form wire:submit.prevent="save" method="post">
        <x-jet-dialog-modal wire:model="showModal">
            <x-slot name="title">
                Edit Item
            </x-slot>
            <x-slot name="content">
                <div class="space-y-4">
                    <x-jet-validation-errors></x-jet-validation-errors>
                    <div class="space-y-1">
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block w-full mt-1" type="text" inputmode="numeric"
                            wire:model="editing.name" name="name" autofocus autocomplete="one-time-code" />
                    </div>

                    <div class="space-y-1">
                        <x-jet-label for="price" value="{{ __('Price') }}" />
                        <x-jet-input id="price" class="block w-full mt-1" type="number" inputmode="numeric"
                            wire:model="editing.price" name="price" />
                    </div>
                    <div class="space-y-1">
                        <x-jet-label for="expire_date" value="{{ __('Expire Date') }}" />
                        <x-jet-input id="expire_date" class="block w-full mt-1" type="date"
                            wire:model="editing.expire_date" name="expire_date" />
                    </div>

                </div>
            </x-slot>
            <x-slot name="footer">
                <button class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-900"
                    type="submit">Update</button>
                <button class="px-6 py-2 text-gray-600 rounded" wire:click="$set('showModal',false)"
                    type="button">Cancel</button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>


</div>
