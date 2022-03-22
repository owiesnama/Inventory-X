<div class="flex flex-col">
    <!-- new tables -->
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            @if (session()->has('message'))
            @endif
            <div class="flex items-end justify-between mb-4">
                <div class="w-1/3 space-y-1">
                    <x-jet-input id="search" class="block w-full mt-1 " type="text" inputmode="numeric"
                        placeholder="Customer info you are search for ..." wire:model="search" name="search" />
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
                            <x-table.heading sortable wire:click="sortBy('address')"
                                :direction="$sorts['address'] ?? null">
                                Address</x-table.heading>
                            <x-table.heading sortable wire:click="sortBy('phone_number')"
                                :direction="$sorts['phone_number'] ?? null">
                                Phone Number</x-table.heading>


                            <th scope="col" class="relative px-6 py-3 text-right">
                                <button class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-900"
                                    wire:click="create">New customer</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($customers as $customer)
                        <tr :wire:key="$customer->id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $customer->name }}</div>
                                        {{-- <div class="text-sm text-gray-500">{{ $customer->Adress }}</div> --}}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $customer->address }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $customer->phone_number }}</div>
                            </td>
                            <td class="px-6 py-4 space-x-4 text-sm font-medium text-right whitespace-nowrap">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900"
                                    wire:click="edit({{ $customer }})">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900"
                                    wire:click="delete({{ $customer }})">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $customers->links() }}
        </div>
    </div>
    <!-- End new tables -->

    <!-- modal -->
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
                Add Customer
            </x-slot>
            <x-slot name="content">
                <div class="space-y-4">
                    <x-jet-validation-errors></x-jet-validation-errors>
                    <div class="space-y-1">
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block w-full mt-1" type="text" inputmode="numeric"
                            wire:model="customer.name" name="name" autofocus autocomplete="one-time-code" />
                    </div>

                    <div class="space-y-1">
                        <x-jet-label for="address" value="{{ __('address') }}" />
                        <x-jet-input id="address" class="block w-full mt-1" type="text" inputmode="numeric"
                            wire:model="customer.address" name="address" />
                    </div>
                    <div class="space-y-1">
                        <x-jet-label for="phone_number" value="{{ __('phone number') }}" />
                        <x-jet-input id="phone_number" class="block w-full mt-1" type="number" inputmode="numeric"
                            wire:model="customer.phone_number" name="phone_number" />
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