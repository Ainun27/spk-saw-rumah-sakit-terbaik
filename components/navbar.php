<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn custom-btn">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>

        <h6 class="nav-title">
            <i class="fa fa-hospital-o"></i> SPK PEMILIHAN RUMAH SAKIT TERBAIK 
            <span class="saw-highlight">METODE SAW</span>
        </h6>
    </div>
</nav>

<style>
/* Navbar utama */
.navbar {
    background: linear-gradient(135deg, #32CD32, #006400); /* gradient hijau dinamis */
    padding: 1rem 1.5rem;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    display: flex;
    align-items: center;
    backdrop-filter: blur(5px); /* efek glass */
}

/* Tombol hamburger */
.custom-btn {
    color: #006400;
    background-color: rgba(255,255,255,0.25);
    border: none;
    padding: 0.6rem 0.8rem;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-right: 1rem;
}
.custom-btn i {
    font-size: 1.4rem;
    transition: all 0.3s ease;
}
.custom-btn:hover {
    background-color: white;
    transform: scale(1.15);
}
.custom-btn:hover i {
    color: #32CD32;
}

/* Judul navbar */
.nav-title {
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}
.nav-title i {
    margin-right: 0.5rem;
    font-size: 1.3rem;
}

/* Highlight untuk METODE SAW */
.saw-highlight {
    background: rgba(255,255,255,0.3);
    padding: 0.2rem 0.5rem;
    border-radius: 6px;
    margin-left: 0.5rem;
    font-weight: bold;
    color: #ffffff;
    text-shadow: 0 1px 2px rgba(0,0,0,0.4);
}

/* Responsive text */
@media (max-width: 768px) {
    .nav-title {
        font-size: 1rem;
    }
    .custom-btn {
        padding: 0.4rem 0.5rem;
    }
    .saw-highlight {
        padding: 0.15rem 0.4rem;
        font-size: 0.85rem;
    }
}
</style>
