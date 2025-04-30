import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { useState } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Analyze',
        href: '/dashboard',
    },
];

const Analyze = () => {
    const [textInput, setTextInput] = useState("");
    const [file, setFile] = useState<File | null>(null);
    const [message, setMessage] = useState("");

    const handleFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        if (event.target.files?.length) {
            setFile(event.target.files[0]);
        }
    };

    const handleSubmit = async (event: React.FormEvent) => {
        event.preventDefault();

        if (!file && !textInput) {
            setMessage("Please upload a file or input some text.");
            return;
        }

        const formData = new FormData();
        if (file) formData.append("file", file);
        formData.append("text_input", textInput);

        try {
            const response = await fetch("/analyze/store", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement)?.content || '',
                },
                body: formData,
            });

            if (response.ok) {
                setMessage("Analysis complete.");
                setTextInput("");
                setFile(null);
            } else {
                setMessage("Error processing your request.");
            }
        } catch (error) {
            setMessage("Network error. Please try again.");
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Analyze" />
            <div className="bg-black flex items-center justify-center h-screen">
                <div className="bg-white p-6 rounded-lg shadow-lg w-1/3">
                    <h2 className='text-xl font-bold mb-4 text-center text-black'>Data Analysis</h2>
                    {message && <p className="text-red-500 mb-2">{message}</p>}
                    <form className="space-y-4" onSubmit={handleSubmit}>
                        <input 
                            className='border p-2 w-full rounded text-black' 
                            type="file" 
                            onChange={handleFileChange} 
                        />
                        <textarea 
                            className='border p-2 w-full rounded text-black' 
                            placeholder='Input Text'
                            value={textInput}
                            onChange={(e) => setTextInput(e.target.value)}
                        />
                        <div className='w-full justify-center items-center text-center'>
                            <button 
                                type="submit" 
                                className='btn-block bg-green-600 text-white rounded px-4 py-2 w-full font-bold'
                            >
                                Analyze
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </AppLayout>
    );
};

export default Analyze;