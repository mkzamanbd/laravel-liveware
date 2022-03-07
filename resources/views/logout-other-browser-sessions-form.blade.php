<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Session
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <strong>Total {{ count($sessions) }} devices found!</strong>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                    <form action="{{ route('logout-other-browser') }}" method="post">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">LOG OUT OTHER BROWSER SESSIONS</button>
                    </form>

                    <div class="flex flex-col">
                        <div class="overflow-x-auto">
                            <div class="py-2 align-middle inline-block w-full">
                                <div class="overflow-hidden border border-1 border-gray-200 rounded">
                                    <table class="w-full leading-normal">
                                        <thead>
                                            <tr>
                                                <th class="text-left px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                    Device
                                                </th>
                                                <th class="text-left px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                    IP
                                                </th>
                                                <th class="text-left px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                    Last Activity
                                                </th>
                                                <th class="text-center px-3 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sessions as $session)
                                                <tr class="border-b border-gray-200 on-parent-hover-show">
                                                    <td class="px-3 py-2 text-sm">
                                                        <a href="#" class="flex items-center no-underline hover:underline">
                                                            <div class="ml-3 d-flex items-center">
                                                                <span class="text-gray-900 whitespace-no-wrap m-0">
                                                                    {{ $session->agent->platform() ? $session->agent->platform() : 'Unknown' }} - {{ $session->agent->browser() ? $session->agent->browser() : 'Unknown' }}
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="px-3 py-2 text-sm">
                                                        <span class="text-gray-900 whitespace-no-wrap">
                                                            {{ $session->ip_address }}
                                                        </span>
                                                    </td>
                                                    </td>
                                                    <td class="px-3 py-2 text-sm">
                                                        <span class="text-gray-900 whitespace-no-wrap">
                                                            {{ $session->last_active }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center px-3 py-2 flex justify-center items-center on-hover-show">
                                                        @if ($session->is_current_device)
                                                            <button disabled class="bg-indigo-500 p-2 hover:bg-indigo-700 text-white rounded-full text-xs flex items-center justify-center mr-2 cursor-pointer">
                                                                This Device
                                                            </button>
                                                        @else
                                                            <a href="{{ route('logout-single-browser', $session->id) }}" class="bg-purple-500 p-2 hover:bg-purple-700 text-white rounded-full text-xs flex items-center justify-center mr-2 cursor-pointer">
                                                                Remove
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
