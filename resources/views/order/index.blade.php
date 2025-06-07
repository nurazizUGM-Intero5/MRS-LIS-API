@extends('layouts.app')
@section('content')
    <section class="bg-white rounded-md shadow-sm p-6 max-w-full overflow-x-auto relative" style="min-width: 700px;">
        <div class="flex justify-between items-start mb-2">
            <div>
                <h2 class="text-lg font-normal text-gray-900">
                    In Progress
                </h2>
                <p class="text-sm text-gray-500">
                    Awaiting Result Entry
                </p>
            </div>
            <button aria-label="Expand" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                <i class="fas fa-expand">
                </i>
            </button>
        </div>
        <h1 class="text-2xl font-extrabold mb-4 select-none">
            1
        </h1>
        <!-- Tabs -->
        <div class="border border-gray-300 rounded-md">
            <div class="flex flex-nowrap overflow-x-auto scrollbar-hide border-b border-gray-300 bg-gray-200 rounded-t-md">
                <button class="px-4 py-2 font-bold text-sm whitespace-nowrap border-b-2 border-blue-600 bg-white"
                    type="button">
                    All
                </button>
                <button class="px-4 py-2 text-sm whitespace-nowrap text-gray-700 hover:bg-gray-300" type="button">
                    Biochemistry
                </button>
                <button class="px-4 py-2 text-sm whitespace-nowrap text-gray-700 hover:bg-gray-300" type="button">
                    Hematology
                </button>
                <button class="px-4 py-2 text-sm whitespace-nowrap text-gray-700 hover:bg-gray-300" type="button">
                    Serology-Immuno...
                </button>
                <button class="px-4 py-2 text-sm whitespace-nowrap text-gray-700 hover:bg-gray-300" type="button">
                    Immunology
                </button>
                <button class="px-4 py-2 text-sm whitespace-nowrap text-gray-700 hover:bg-gray-300" type="button">
                    Molecular Biology
                </button>
                <button class="px-4 py-2 text-sm whitespace-nowrap text-gray-700 hover:bg-gray-300" type="button">
                    Cytology
                </button>
                <button class="px-4 py-2 text-sm whitespace-nowrap text-gray-700 hover:bg-gray-300" type="button">
                    Serology
                </button>
                <button class="px-4 py-2 text-sm whitespace-nowrap text-gray-700 hover:bg-gray-300" type="button">
                    Virology
                </button>
                <button class="px-4 py-2 text-sm whitespace-nowrap text-gray-700 hover:bg-gray-300" type="button">
                    Pathology
                </button>
                <button class="px-4 py-2 text-sm whitespace-nowrap text-gray-700 hover:bg-gray-300" type="button">
                    Immunohistoche...
                </button>
            </div>
            <!-- Table -->
            <table class="w-full border-collapse border border-gray-300 text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 font-semibold px-3 py-2 text-left">
                            Priority
                        </th>
                        <th class="border border-gray-300 font-semibold px-3 py-2 text-left">
                            Order Date
                        </th>
                        <th class="border border-gray-300 font-semibold px-3 py-2 text-left">
                            Patient Id
                        </th>
                        <th class="border border-gray-300 font-semibold px-3 py-2 text-left">
                            Lab Number
                        </th>
                        <th class="border border-gray-300 font-semibold px-3 py-2 text-left">
                            Test Name
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="even:bg-white odd:bg-gray-50">
                            <td class="border border-gray-300 px-3 py-2">
                                {{ $order->priority }}
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                {{ $order->authoredOn }}
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                {{ $order->subject->reference }}
                            </td>
                            <td class="border border-gray-300 px-3 py-2 flex items-center space-x-2">
                                <input aria-label="Select lab number {{ $order->requisition->value }}" type="checkbox" />
                                <a class="text-blue-600 hover:underline" href="{{ route('lab-orders.show', $order->id) }}">
                                    {{ $order->requisition->value }}
                                </a>
                            </td>
                            <td class="border border-gray-300 px-3 py-2">
                                {{ $order->code->coding[0]->display }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div
                class="flex items-center justify-between px-4 py-2 border-t border-gray-300 text-xs text-gray-700 select-none">
                <div class="flex items-center space-x-2">
                    <span class="font-semibold">
                        Items per page
                    </span>
                    <select aria-label="Items per page" class="border border-gray-300 rounded px-1 py-0.5 text-xs">
                        <option>
                            100
                        </option>
                    </select>
                </div>
                <div class="flex items-center space-x-4">
                    <span>
                        1-1 of 1 items
                    </span>
                    <div class="flex items-center space-x-1 border-l border-r border-gray-300 px-2">
                        <select aria-label="Page number"
                            class="border border-gray-300 rounded px-1 py-0.5 text-xs font-semibold">
                            <option>
                                1
                            </option>
                        </select>
                    </div>
                    <button aria-label="Previous page" class="disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled="">
                        <i class="fas fa-chevron-left text-gray-600">
                        </i>
                    </button>
                    <button aria-label="Next page" class="disabled:opacity-50 disabled:cursor-not-allowed" disabled="">
                        <i class="fas fa-chevron-right text-gray-600">
                        </i>
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection
