<div class="mt-6">
    <h2 class="text-lg font-bold">Uploaded Files</h2>
    <table class="w-full border-collapse border border-gray-300 mt-2">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">ID</th>
                <th class="border p-2">User</th>
                <th class="border p-2">Image</th>
                <th class="border p-2">Description</th>
                <th class="border p-2">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($analyses as $analysis)
                <tr class="text-center">
                    <td class="border p-2">{{ $analysis->id }}</td>
                    <td class="border p-2">{{ $analysis->user->name }}</td>
                    <td class="border p-2">
                        <img src="{{ asset('storage/' . $analysis->image) }}" class="w-16 h-16">
                    </td>
                    <td class="border p-2">{{ $analysis->description }}</td>
                    <td class="border p-2">{{ $analysis->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
