<div>
    <!-- table -->
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            @if (session()->has('message'))
            @endif
            <div class="flex items-end justify-between mb-4">
                <div class="w-1/3 space-y-1">
                    <x-jet-input id="search" class="block w-full mt-1 " type="text" inputmode="numeric"
                        placeholder="Storage you are searching ..." wire:model="search" name="search" />
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
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Item</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Quantity</th>
                            <th scope="col" class="relative px-6 py-3 text-right">
                                <button class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-900"
                                    wire:click="toggleAddingModal">New
                                    Storage</button>
                            </th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($storage->items as $item)
                        <tr :wire:key="'storage-'.$storage->id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><a
                                                href="{{ url('storages/'. $storage->id) }}">
                                                {{ $item->name }}
                                               

                                            </a></div>

                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    5
                                </div>
                               
                            </td>
                            <td class="px-6 py-4 space-x-4 text-sm font-medium text-right whitespace-nowrap">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900" wire:click="update({{ $item->id }})">Edit</a>                                <a href="#" class="text-red-600 hover:text-red-900"
                                    wire:click="confirmingDeletion({{ $storage }})">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
    <!-- table End -->


    <form wire:submit.prevent="store()" method="post">
        <x-jet-dialog-modal wire:model="isAddingNewItem">
            <x-slot name="title">
                New Storage
            </x-slot>
            <x-slot name="content">
                <div class="space-y-4">
                    <x-jet-validation-errors></x-jet-validation-errors>
                    <div class="space-y-1">
                        <div class="flex justify-center">
                            <div class="mb-3 xl:w-96">
                                <select class="form-select appearance-none
                                block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding bg-no-repeat
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    aria-label="Default select example" wire:model="item">
                                    <option selected> Items</option>
                                    @foreach ($items as $item) --}}

                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="space-y-1">
                        <x-jet-label for="address" value="{{ __('Quantity') }}" />
                        <x-jet-input id="address" class="block w-full mt-1" type="number" inputmode="numeric"
                            wire:model="storageItem.quantity" name="Address" x-ref="name" wire:model="quantity" />
                    </div>



                </div>
            </x-slot>
            <x-slot name="footer">
                <button class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-900" type="submit">Save
                    Storage</button>
                <button class="px-6 py-2 text-gray-600 rounded" wire:click="toggleAddingModal()"
                    type="button">Cancel</button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>


        <!-- Update modal form -->
        <form wire:submit.prevent="edit()" method="post">
            <x-jet-dialog-modal wire:model="isUpdating">
                <x-slot name="title">
                    Edit Storage
                </x-slot>
                <x-slot name="content">
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <div class="flex justify-center">
                                <div class="mb-3 xl:w-96">
                                    <select class="form-select appearance-none
                                    block
                                    w-full
                                    px-3
                                    py-1.5
                                    text-base
                                    font-normal
                                    text-gray-700
                                    bg-white bg-clip-padding bg-no-repeat
                                    border border-solid border-gray-300
                                    rounded
                                    transition
                                    ease-in-out
                                    m-0
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        aria-label="Default select example" wire:model="item">
                                        <option selected> Items</option>
                                        @foreach ($items as $item) --}}
    
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
    
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <button class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-900" type="submit">Update</button>
                    <button class="px-6 py-2 text-gray-600 rounded" wire:click="toggleUpdaingModal()"
                        type="button">Cancel</button>
                </x-slot>
            </x-jet-dialog-modal>
        </form>
        <!-- End Update modal form -->
    
</div>