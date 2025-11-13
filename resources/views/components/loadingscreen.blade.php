<!-- Loading Screen Component -->
<div id="loading">
    <div class="loader"></div>
</div>

<style>
    /* 🔄 Loading Screen */
    #loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: #141414;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 1s ease;
    }

    #loading.fade-out {
        opacity: 0;
        pointer-events: none;
    }

    /* 🔁 Animasi Spinner */
    .loader {
        width: 80px;
        aspect-ratio: 1;
        display: grid;
        color: #00bcd4;
        background: radial-gradient(farthest-side, currentColor calc(100% - 6px), #0000 calc(100% - 5px) 0);
        mask: radial-gradient(farthest-side, #0000 calc(100% - 13px), #000 calc(100% - 12px));
        -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 13px), #000 calc(100% - 12px));
        border-radius: 50%;
        animation: l19 2s infinite linear;
    }

    .loader::before,
    .loader::after {
        content: "";
        grid-area: 1/1;
        background:
            linear-gradient(currentColor 0 0) center,
            linear-gradient(currentColor 0 0) center;
        background-size: 100% 10px, 10px 100%;
        background-repeat: no-repeat;
    }

    .loader::after {
        transform: rotate(45deg);
    }

    @keyframes l19 {
        100% {
            transform: rotate(1turn);
        }
    }
</style>

<script>
    window.addEventListener('load', () => {
        setTimeout(() => {
            const loading = document.getElementById('loading');
            loading.classList.add('fade-out');
            
            // Hapus element setelah animasi selesai
            setTimeout(() => {
                loading.style.display = 'none';
            }, 1000);
        }, 1500); // Loading duration: 1.5 detik
    });
</script>