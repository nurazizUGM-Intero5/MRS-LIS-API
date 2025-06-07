@extends('layouts.app')
@section('content')
    <!-- Info Box -->
    <section aria-live="polite"
        class="mt-6 max-w-4xl border border-gray-300 rounded shadow-sm flex items-center gap-2 px-4 py-3 text-xs sm:text-sm select-none"
        role="alert">
        <img alt="Red arrow icon pointing up" class="w-5 h-5" height="20"
            src="https://storage.googleapis.com/a1aa/image/8d4aa844-a8c1-4b2f-717d-f8c112dcde91.jpg" width="20" />
        <span>
            = Sample or Order is nonconforming or Test has been rejected
        </span>
    </section>
    <!-- Table -->
    <section class="mt-6 max-w-full overflow-x-auto scrollbar-x">
        <table class="min-w-[900px] w-full border-collapse border border-gray-200 text-xs sm:text-sm">
            <thead class="bg-white border-b border-gray-300">
                <tr>
                    <th class="border border-gray-200 px-2 py-2 text-left w-6">
                    </th>
                    <th class="border border-gray-200 px-2 py-2 text-left w-36">
                        Sample Info
                    </th>
                    <th class="border border-gray-200 px-2 py-2 text-left w-24">
                        Test Date
                    </th>
                    <th class="border border-gray-200 px-2 py-2 text-left w-20">
                        Analyzer ...
                    </th>
                    <th class="border border-gray-200 px-2 py-2 text-left w-48">
                        Test Name
                    </th>
                    <th class="border border-gray-200 px-2 py-2 text-left w-24">
                        Normal Range
                    </th>
                    <th class="border border-gray-200 px-2 py-2 text-center w-12">
                        Accept
                    </th>
                    <th class="border border-gray-200 px-2 py-2 text-left w-28">
                        Result
                    </th>
                    <th class="border border-gray-200 px-2 py-2 text-left w-28">
                        Current Result
                    </th>
                    <th class="border border-gray-200 px-2 py-2 text-left w-16">
                        Notes
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1 -->
                <tr class="border-b border-gray-200 hover:bg-gray-50 cursor-pointer">
                    <td class="border border-gray-200 px-1 py-2 text-center align-top">
                        <i class="fas fa-chevron-right text-gray-600">
                        </i>
                    </td>
                    <td class="border border-gray-200 px-2 py-2 align-top">
                        <div class="flex items-start gap-1">
                            <i class="far fa-copy text-gray-600 mt-0.5">
                            </i>
                            <div class="text-[10px] leading-tight">
                                <div>
                                    {{ $order->requisition->value }}
                                </div>
                                <div>
                                    {{-- patient name --}}
                                </div>
                                <div>
                                    {{-- age, gender, birth date --}}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="border border-gray-200 px-2 py-2 align-top">
                        {{-- created at --}}
                        {{ \Carbon\Carbon::parse($order->authoredOn)->format('d/m/Y') }}
                    </td>
                    <td class="border border-gray-200 px-2 py-2 align-top font-semibold">
                        MANUAL
                    </td>
                    <td class="border border-gray-200 px-2 py-2 align-top text-[10px] leading-tight">
                        {{ $order->code->coding[0]->display }}
                    </td>
                    <td class="border border-gray-200 px-2 py-2 align-top">
                    </td>
                    <td class="border border-gray-200 px-2 py-2 align-top text-center">
                        <input aria-label="Accept checkbox row 1" class="w-4 h-4" type="checkbox" />
                    </td>
                    <td class="border border-gray-200 px-2 py-2 align-top">
                        <textarea aria-label="Result input row 1"
                            class="w-full resize-none border border-gray-200 bg-gray-100 text-xs px-1 py-1" rows="1"></textarea>
                    </td>
                    <td class="border border-gray-200 px-2 py-2 align-top">
                        -
                    </td>
                    <td class="border border-gray-200 px-2 py-2 align-top">
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
    <!-- Pagination and Items per page -->
    <section aria-label="Pagination and items per page"
        class="mt-2 max-w-4xl flex flex-wrap items-center gap-2 text-xs sm:text-sm text-gray-700 select-none">
        <div class="flex items-center gap-1 border border-gray-300 rounded px-2 py-1">
            <span>
                Items per page
            </span>
            <select aria-label="Items per page" class="border border-gray-300 rounded text-xs sm:text-sm px-1 py-0.5 ml-1"
                value="100">
                <option>
                    10
                </option>
                <option>
                    25
                </option>
                <option selected="">
                    100
                </option>
            </select>
        </div>
        <div>
            1-2 of 2 items
        </div>
        <div class="flex items-center gap-1 ml-auto border border-gray-300 rounded px-2 py-1">
            <select aria-label="Page number" class="border border-gray-300 rounded text-xs sm:text-sm px-1 py-0.5"
                value="1">
                <option selected="">
                    1
                </option>
            </select>
            <span>
                of 1 page
            </span>
            <button aria-label="Previous page" class="disabled:opacity-50 disabled:cursor-not-allowed" disabled="">
                <i class="fas fa-chevron-left">
                </i>
            </button>
            <button aria-label="Next page" class="disabled:opacity-50 disabled:cursor-not-allowed" disabled="">
                <i class="fas fa-chevron-right">
                </i>
            </button>
        </div>
    </section>
    <!-- Save Button -->
    <section class="mt-6 max-w-xl">
        <button onclick="window.location.href='{{ route('lab-orders.index') }}'"
            class="bg-blue-600 text-white text-xs sm:text-sm font-semibold px-6 py-2 rounded-sm hover:bg-blue-700 transition"
            type="button">
            Save
        </button>
    </section>
@endsection
