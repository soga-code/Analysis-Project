import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Analyze',
        href: '/dashboard',
    },
];

export default function Analyze() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Analyze" />
            <div className='login-signup-form animated fadeInDown'>
      <div className="form">
        <form onSubmit={onsubmit}>
          <h1 className='title'>Submit your document</h1>
          <input type="upload" placeholder="Upload document"/>
          <input type="input" placeholder='Input document'/>
          <button className='btn btn-block'></button>
        </form>
      </div>
    </div>
        </AppLayout>
    );
}
