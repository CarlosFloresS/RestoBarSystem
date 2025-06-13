<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Toma de pedidos') }}
        </h2>
    </x-slot>

    <div class="pt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <select onchange="window.location.href='/orders/take/tables/'+this.value">
            @foreach($tables as $table)
                <option
                    value="{{$table->id}}" {{$selectedTable->id == $table->id ? 'selected': ''}}>{{$table->name}}</option>
            @endforeach
        </select>
    </div>
    <div x-data="takeOrders">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="grid grid-cols-6 gap-5">
                            <template x-for="entry in menuEntries">
                                <div class="p-5 bg-indigo-300 rounded shadow-md">
                                    <div class="font-bold" x-text="entry.name"></div>
                                    <div class="text-sm text-gray-600" x-text="entry.description"></div>
                                    <div x-text="'S/'+entry.price"></div>
                                    <div>
                                        <button @click="addToOrder(entry, 1)"
                                                class="bg-blue-950 text-white px-5 rounded">Añadir
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="space-y-2">
                            <div class="grid grid-cols-4 font-bold">
                                <div>Descripción</div>
                                <div class="text-center">Precio</div>
                                <div class="text-center">Cantidad</div>
                                <div class="text-center">Acciones</div>
                            </div>

                            <template x-for="order in selectedTable.orders">
                                <div class="grid grid-cols-4">
                                    <div x-text="order.menu_entry.name"></div>
                                    <div class="text-center" x-text="'S/'+order.menu_entry.price"></div>
                                    <div class="text-center" x-text="order.quantity"></div>
                                    <div class="text-center">
                                        <button class="bg-blue-950 text-white px-5 rounded">+</button>
                                        <button class="bg-blue-950 text-white px-5 rounded">-</button>
                                    </div>
                                </div>
                            </template>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('takeOrders', () => ({
                menuEntries: {!! $menuEntries->toJson() !!},
                selectedTable: {!! $selectedTable->toJson() !!},

                addToOrder(entry, quantity) {
                    axios.post('/orders/take/tables/' + this.selectedTable.id, {
                        menu_entry_id: entry.id,
                        quantity: quantity,
                    })
                }
            }))
        })
    </script>

</x-app-layout>
