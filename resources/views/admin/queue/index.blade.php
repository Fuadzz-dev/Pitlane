@extends('admin.layouts.App')

@section('title', 'Queue Management')
@section('page-title', 'Queue Management')

@section('content')
<div class="content-section">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Kelola Antrian Servis</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if($queues->isEmpty())
        <div class="empty-state">
            <p>Tidak ada antrian aktif saat ini</p>
        </div>
    @else
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No. Antrian</th>
                        <th>Nama Customer</th>
                        <th>Bengkel</th>
                        <th>Motor</th>
                        <th>Tanggal Servis</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($queues as $queue)
                    <tr>
                        <td><strong>#{{ $queue->antrian_id }}</strong></td>
                        <td>{{ $queue->user_name }}</td>
                        <td>{{ $queue->nama_bengkel }}</td>
                        <td>{{ $queue->tipe }} ({{ $queue->plat }})</td>
                        <td>{{ \Carbon\Carbon::parse($queue->tanggal_servis)->format('d M Y') }}</td>
                        <td>
                            <span class="status-badge status-{{ $queue->status }}">
                                {{ ucfirst($queue->status) }}
                            </span>
                        </td>
                        <td>
                            <button class="btn-action" onclick="openModal({{ $queue->antrian_id }}, '{{ $queue->status }}')">
                                Update
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Modal Update Status -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3>Update Status Antrian</h3>
        
        <form id="updateForm" method="POST" action="">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Status</label>
                <select name="status" id="statusSelect" required onchange="toggleFields()">
                    <option value="menunggu">Menunggu</option>
                    <option value="diproses">Diproses</option>
                    <option value="selesai">Selesai</option>
                    <option value="batal">Batal</option>
                </select>
            </div>

            <div class="form-group" id="mekanikField" style="display: none;">
    <label>Mekanik (Opsional)</label>
    <select name="mekanik_id">
        <option value="">-- Pilih Mekanik --</option>
        @foreach ($mekaniks as $m)
            <option value="{{ $m->mekanik_id }}">{{ $m->nama_mekanik }}</option>
        @endforeach
    </select>
</div>

            <div class="form-group" id="biayaField" style="display: none;">
                <label>Total Biaya</label>
                <input type="number" name="total_biaya" min="0" step="1000" placeholder="Masukkan total biaya">
            </div>

            <div class="form-group" id="keteranganField" style="display: none;">
                <label>Keterangan</label>
                <textarea name="keterangan" rows="3" placeholder="Catatan tambahan..."></textarea>
            </div>

            <button type="submit" class="btn-primary">Update Status</button>
        </form>
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
        margin: 0 0 20px 0;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #888;
    }
.table-container {
    width: 100%;
    padding: 15px;
    border-radius: 18px;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(8px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}

table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border-radius: 16px;
}

/* Header tabel */
table thead th {
    background: linear-gradient(90deg, #5d6ae6, #6d5fd8, #7b4cc7);
    color: #ffffff;
    padding: 16px;
    font-size: 15px;
    font-weight: 600;
    text-align: left;
}

/* Baris tabel */
table tbody tr {
    background: rgba(255, 255, 255, 0.08);
    border-bottom: 1px solid rgba(255,255,255,0.1);
    color: #f0f0f0;
}

table tbody tr:hover {
    background: rgba(255,255,255,0.15);
}

table td {
    padding: 15px;
    font-size: 15px;
}

/* Teks link alamat */
table a {
    color: #9db9ff;
    text-decoration: underline;
}

/* === Badge Status === */
.status-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    display: inline-block;
}

.status-menunggu {
    background: #fff6a3;
    color: #6d6300;
}
.status-diproses {
    background: #c6f2f7;
    color: #005a66;
}
.status-selesai {
    background: #c7f4d6;
    color: #0d6f36;
}
.status-batal {
    background: #f7c6c6;
    color: #7a1f1f;
}

/* Tombol Update */
.btn-action {
    padding: 8px 22px;
    background: linear-gradient(90deg, #5f8dff, #6d6af9);
    color: white;
    border-radius: 10px;
    border: none;
    font-weight: 500;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    transition: 0.25s ease;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.35);
}
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.6);
        backdrop-filter: blur(5px);
    }

    .modal-content {
        background: white;
        margin: 5% auto;
        padding: 30px;
        border-radius: 15px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        transition: color 0.3s;
    }

    .close:hover {
        color: #000;
    }

    .modal-content h3 {
        color: #333;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        color: #555;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .form-group select,
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-group select:focus,
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
    }

    .btn-primary {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }
</style>
@endsection

@section('scripts')
<script>
    let currentQueueId = null;

    function openModal(queueId, currentStatus) {
        currentQueueId = queueId;
        document.getElementById('updateModal').style.display = 'block';
        document.getElementById('statusSelect').value = currentStatus;
        document.getElementById('updateForm').action = `/admin/queue/${queueId}/update`;
        toggleFields();
    }

    function closeModal() {
        document.getElementById('updateModal').style.display = 'none';
        document.getElementById('updateForm').reset();
    }

    function toggleFields() {
        const status = document.getElementById('statusSelect').value;
        const mekanikField = document.getElementById('mekanikField');
        const biayaField = document.getElementById('biayaField');
        const keteranganField = document.getElementById('keteranganField');

        // Show fields based on status
        if (status === 'selesai') {
            mekanikField.style.display = 'block';
            biayaField.style.display = 'block';
            keteranganField.style.display = 'block';
        } else if (status === 'batal') {
            mekanikField.style.display = 'none';
            biayaField.style.display = 'none';
            keteranganField.style.display = 'block';
        } else {
            mekanikField.style.display = 'none';
            biayaField.style.display = 'none';
            keteranganField.style.display = 'none';
        }
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('updateModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>
@endsection
@endsection