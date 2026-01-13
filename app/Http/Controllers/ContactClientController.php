<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactClientController extends Controller
{
    /**
     * Display a listing of clients.
     */
    public function index(Request $request)
    {
        $query = Client::query();

        // Filter by type
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        // Search by name, phone, or email
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $clients = $query->latest()->paginate(15);
        $typeLabels = Client::getTypeLabels();

        return view('admin.contacts.index', compact('clients', 'typeLabels'));
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        $typeLabels = Client::getTypeLabels();
        return view('admin.contacts.create', compact('typeLabels'));
    }

    /**
     * Store a newly created client.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'type' => 'required|in:client,owner,broker,investor',
            'notes' => 'nullable|string',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
        ]);

        Client::create($request->all());

        return redirect()->route('contacts.index')
            ->with('success', 'تم إضافة العميل بنجاح');
    }

    /**
     * Show the form for editing a client.
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $typeLabels = Client::getTypeLabels();
        return view('admin.contacts.edit', compact('client', 'typeLabels'));
    }

    /**
     * Update the specified client.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'type' => 'required|in:client,owner,broker,investor',
            'notes' => 'nullable|string',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
        ]);

        $client = Client::findOrFail($id);
        $client->update($request->all());

        return redirect()->route('contacts.index')
            ->with('success', 'تم تحديث بيانات العميل بنجاح');
    }

    /**
     * Remove the specified client.
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'تم حذف العميل بنجاح');
    }

    /**
     * Show form to send offer to client.
     */
    public function sendOfferForm($id)
    {
        $client = Client::findOrFail($id);
        $properties = Property::all();
        return view('admin.contacts.send_offer', compact('client', 'properties'));
    }

    /**
     * Send offer via WhatsApp.
     */
    public function sendWhatsApp(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $property = Property::findOrFail($request->property_id);

        // Build WhatsApp message
        $message = "مرحباً {$client->name}\n\n";
        $message .= "نود أن نعرض عليك العقار التالي:\n\n";
        $message .= "📍 الموقع: {$property->Location}\n";
        $message .= "📐 المساحة: {$property->area} م²\n";
        $message .= "💰 السعر: {$property->price} ريال\n";

        if ($property->property_type) {
            $message .= "🏠 النوع: {$property->property_type}\n";
        }

        if ($request->custom_message) {
            $message .= "\n{$request->custom_message}";
        }

        $message .= "\n\n🏢 أبو نواف للعقارات";

        // Clean phone number and create WhatsApp URL
        $phone = preg_replace('/[^0-9]/', '', $client->phone);
        if (substr($phone, 0, 1) === '0') {
            $phone = '966' . substr($phone, 1);
        } elseif (substr($phone, 0, 3) !== '966') {
            $phone = '966' . $phone;
        }

        $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

        return redirect()->away($whatsappUrl);
    }

    /**
     * Send offer via Email.
     */
    public function sendEmail(Request $request, $id)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'subject' => 'required|string|max:255',
        ]);

        $client = Client::findOrFail($id);
        $property = Property::findOrFail($request->property_id);

        if (!$client->email) {
            return back()->with('error', 'هذا العميل ليس لديه بريد إلكتروني');
        }

        // Build email content
        $emailContent = "مرحباً {$client->name}\n\n";
        $emailContent .= "نود أن نعرض عليك العقار التالي:\n\n";
        $emailContent .= "الموقع: {$property->Location}\n";
        $emailContent .= "المساحة: {$property->area} م²\n";
        $emailContent .= "السعر: {$property->price} ريال\n";

        if ($property->property_type) {
            $emailContent .= "النوع: {$property->property_type}\n";
        }

        if ($request->custom_message) {
            $emailContent .= "\n{$request->custom_message}";
        }

        $emailContent .= "\n\nأبو نواف للعقارات";

        try {
            Mail::raw($emailContent, function($message) use ($client, $request) {
                $message->to($client->email)
                        ->subject($request->subject);
            });

            return back()->with('success', 'تم إرسال البريد الإلكتروني بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'فشل إرسال البريد الإلكتروني: ' . $e->getMessage());
        }
    }
}
