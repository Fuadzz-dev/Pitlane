@extends('admin.layouts.App')

@section('title', 'Motorcycles Management')
@section('page-title', 'Motorcycles Management')

@section('content')
<div class="content-section">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Registered Motorcycles</h2>
        <button class="btn-primary" onclick="alert('Feature coming soon!')">+ Add New Motorcycle</button>
    </div>
    
    <div style="margin-top: 30px; padding: 30px; background: rgba(255,255,255,0.05); border-radius: 12px; text-align: center;">
        <p style="color: #888;">Motorcycles management is under development.</p>
        <p style="color: #666; font-size: 14px; margin-top: 10px;">This feature will allow you to manage all registered motorcycles in the system.</p>
    </div>
</div>

@section('styles')
<style>
    .content-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .content-section h2 {
        color: #333;
        margin: 0;
    }

    .btn-primary {
        padding: 12px 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
</style>
@endsection
@endsection