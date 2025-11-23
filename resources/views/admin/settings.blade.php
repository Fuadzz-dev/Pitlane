@extends('admin.layouts.App')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('content')
<div class="content-section">
    <h2>Application Settings</h2>
    <p style="color: #888; margin-top: 10px;">Manage your application configuration and preferences</p>
    
    <div style="margin-top: 30px; padding: 30px; background: rgba(255,255,255,0.05); border-radius: 12px;">
        <p style="color: #ccc;">Settings page is under development.</p>
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
        margin-bottom: 5px;
    }
</style>
@endsection
@endsection