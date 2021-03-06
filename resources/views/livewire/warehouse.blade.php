<div class="flex flex-col">
    <!-- new Table -->
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            @if (session()->has('message'))
            @endif
            <div class="flex items-end justify-between mb-4">
                <div class="w-1/3 space-y-1">
                    <x-jet-input id="search" class="block w-full mt-1 " type="text" inputmode="numeric"
                        placeholder="Warehouse you are searching ..." wire:model="search" name="search" />
                </div>
                <div class="space-y-1">
                    <x-jet-label for="perPage" value="{{ __('Per page') }}" />

                    <select id="perPage"
                        class="block w-24 mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        type="number" inputmode="numeric" wire:model="perPage" name="perPage">
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
                            <x-table.heading sortable wire:click="sortBy('title')" :direction="$sorts['title'] ?? null">
                                Title</x-table.heading>
                            <x-table.heading sortable wire:click="sortBy('Address')"
                                :direction="$sorts['Address'] ?? null">
                                Address</x-table.heading>


                            <th scope="col" class="relative px-6 py-3 text-right">
                                <button class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-900"
                                    wire:click="create">New Warehouse</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($warehouses as $warehouse)
                        <tr :wire:key="'warehouse-'.$warehouse->id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="{{ url('warehouses/' . $warehouse->id) }}">
                                                {{ $warehouse->title }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $warehouse->Address }}</div>
                            </td>
                            <td class="px-6 py-4 space-x-4 text-sm font-medium text-right whitespace-nowrap">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900"
                                    wire:click="edit({{ $warehouse }})">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900"
                                    wire:click="delete({{ $warehouse }})">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $warehouses->links() }}
        </div>
    </div>
    <!-- End new Table -->



    <!-- Warehouse modal form -->
    <form wire:submit.prevent="save" method="post">
        <x-jet-dialog-modal wire:model="showModal">
            <x-slot name="title">
                New Warehouse
            </x-slot>
            <x-slot name="content">
                <div class="space-y-4">
                    <x-jet-validation-errors></x-jet-validation-errors>
                    <div class="space-y-1">
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block w-full mt-1" type="text" inputmode="numeric"
                            wire:model="warehouse.title" name="title" autofocus x-ref="name"
                            autocomplete="one-time-code" />
                    </div>
                    <div class="space-y-1">
                        <x-jet-label for="address" value="{{ __('Address') }}" />
                        <x-jet-input id="address" class="block w-full mt-1" type="text" inputmode="numeric"
                            wire:model="warehouse.Address" name="Address" x-ref="name" />
                    </div>

                </div>
            </x-slot>
            <x-slot name="footer">
                <button class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-900" type="submit">Save
                    Warehouse</button>
                <button class="px-6 py-2 text-gray-600 rounded" wire:click="showModal()" type="button">Cancel</button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>
    <!-- End Warehouse modal form -->



    <form method="post" wire:submit.prevent="destroy()">
        <x-jet-confirmation-modal wire:model="deleting">
            <x-slot name="title">
                Are you sure you want to delete <strong>{{ optional($deleting)->title }}</strong>
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





</div>