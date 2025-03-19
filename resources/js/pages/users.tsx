import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, router, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Users', href: '/users' }];
const handleDelete = (id: Number) => {
    router.delete(`/users/${id}`);
};

export default function Users() {
    const { users } = usePage<{ users: { data: { id: Number; name: String; email: String; created_at: String }[] } }>().props;

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Users" />
            <div className="flex flex-1 flex-col gap-4 rounded-xl bg-black p-4 text-white shadow-md">
                <table className="w-full border-collapse border text-white">
                    <thead>
                        <tr className="bg-gray-800">
                            {['ID', 'Name', 'Email', 'Created At', 'Actions'].map((header) => (
                                <th key={header} className="border border-gray-600 p-2">
                                    {header}
                                </th>
                            ))}
                        </tr>
                    </thead>
                    <tbody>
                        {users.data.length ? (
                            users.data.map(({ id, name, email, created_at }) => (
                                <tr key={id} className="hover:bg-gray-700">
                                    {[id, name, email, new Date(created_at).toLocaleDateString()].map((value, i) => (
                                        <td key={i} className="border border-gray-600 p-2">
                                            {value}
                                        </td>
                                    ))}

                                    <td className="border border-gray-600 p-2 text-center">
                                        <button onClick={() => handleDelete(id)} className="rounded border bg-red-600 px-3 text-center text-white">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            ))
                        ) : (
                            <tr>
                                <td colSpan={4} className="p-4 text-center">
                                    No users found
                                </td>
                            </tr>
                        )}
                    </tbody>
                </table>
            </div>
        </AppLayout>
    );
}
