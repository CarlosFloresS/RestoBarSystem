<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Toma de pedidos') }}
        </h2>
    </x-slot>

    <div class="pt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <select>
            <option>Mesa 1</option>
            <option>Mesa 2</option>
            <option>Mesa 3</option>
        </select>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="grid grid-cols-6 gap-5">
                        <div class="p-5 bg-indigo-300 rounded shadow-md">
                            <div class="font-bold">Item 1</div>
                            <div>$ 4.75</div>
                            <div>
                                <button class="bg-blue-950 text-white px-5 rounded">+</button>
                                <button class="bg-blue-950 text-white px-5 rounded">-</button>
                            </div>
                        </div>
                        <div class="p-5 bg-indigo-300 rounded shadow-md">
                            <div class="font-bold">Item 2</div>
                            <div>$ 4.75</div>
                            <div>
                                <button class="bg-blue-950 text-white px-5 rounded">+</button>
                                <button class="bg-blue-950 text-white px-5 rounded">-</button>
                            </div>
                        </div>
                        <div class="p-5 bg-indigo-300 rounded shadow-md">
                            <div class="font-bold">Item 3</div>
                            <div>$ 4.75</div>
                            <div>
                                <button class="bg-blue-950 text-white px-5 rounded">+</button>
                                <button class="bg-blue-950 text-white px-5 rounded">-</button>
                            </div>
                        </div>
                        <div class="p-5 bg-indigo-300 rounded shadow-md">
                            <div class="font-bold">Item 4</div>
                            <div>$4.75</div>
                            <div>
                                <button class="bg-blue-950 text-white px-5 rounded">+</button>
                                <button class="bg-blue-950 text-white px-5 rounded">-</button>
                            </div>
                        </div>
                        <div class="p-5 bg-indigo-300 rounded shadow-md">
                            <div class="font-bold">Item 5</div>
                            <div>$4.75</div>
                            <div>
                                <button class="bg-blue-950 text-white px-5 rounded">+</button>
                                <button class="bg-blue-950 text-white px-5 rounded">-</button>
                            </div>
                        </div>
                        <div class="p-5 bg-indigo-300 rounded shadow-md">
                            <div class="font-bold">Item 6</div>
                            <div>$4.75</div>
                            <div>
                                <button class="bg-blue-950 text-white px-5 rounded">+</button>
                                <button class="bg-blue-950 text-white px-5 rounded">-</button>
                            </div>
                        </div>
                        <div class="p-5 bg-indigo-300 rounded shadow-md">
                            <div class="font-bold">Item 7</div>
                            <div>$4.75</div>
                            <div>
                                <button class="bg-blue-950 text-white px-5 rounded">+</button>
                                <button class="bg-blue-950 text-white px-5 rounded">-</button>
                            </div>
                        </div>
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

                        <div class="grid grid-cols-4">
                            <div>Hamburguesa de queso</div>
                            <div class="text-center">$5.20</div>
                            <div class="text-center">2</div>
                            <div class="text-center">
                                <button class="bg-blue-950 text-white px-5 rounded">+</button>
                                <button class="bg-blue-950 text-white px-5 rounded">-</button>
                            </div>
                        </div>

                        <div class="grid grid-cols-4">
                            <div>Hamburguesa de pollo</div>
                            <div class="text-center">$5.90</div>
                            <div class="text-center">5</div>
                            <div class="text-center">
                                <button class="bg-blue-950 text-white px-5 rounded">+</button>
                                <button class="bg-blue-950 text-white px-5 rounded">-</button>
                            </div>
                        </div>

                        <div class="grid grid-cols-4">
                            <div>Hamburguesa de Salmón</div>
                            <div class="text-center">$7.0</div>
                            <div class="text-center">3</div>
                            <div class="text-center">
                                <button class="bg-blue-950 text-white px-5 rounded">+</button>
                                <button class="bg-blue-950 text-white px-5 rounded">-</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
