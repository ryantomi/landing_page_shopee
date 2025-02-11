<?php
session_start(); 
if (!isset($_SESSION['username'])) {

    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #1a202c;
            color: #f7fafc;
            font-family: 'Arial', sans-serif;
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .slide-in {
            animation: slideIn 0.5s ease-in-out;
        }
        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .dashboard-container {
            background-color: #2d3748; /* Warna latar belakang untuk kontainer */
            padding: 20px; /* Padding di sekitar konten */
            border-radius: 10px; /* Sudut membulat */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Bayangan halus untuk kedalaman */
            text-align: center; /* Rata tengah teks */
            margin-bottom: 20px; /* Ruang di bawah kontainer */
        }
        .dashboard-container h2 {
            font-size: 2rem; /* Ukuran font untuk judul */
            color: #edf2f7; /* Warna terang untuk judul */
            margin-bottom: 10px; /* Ruang di bawah judul */
        }
        .dashboard-container p {
            font-size: 1.125rem; /* Ukuran font untuk paragraf */
            color: #e2e8f0; /* Warna medium untuk paragraf */
            margin-bottom: 20px; /* Ruang di bawah paragraf */
        }
        .logout-button {
            display: inline-block; /* Membuat tautan berperilaku seperti tombol */
            background-color: #e53e3e; /* Warna latar belakang merah untuk tombol logout */
            color: white; /* Warna teks putih */
            padding: 10px 20px; /* Padding untuk tombol */
            border-radius: 5px; /* Sudut membulat */
            text-decoration: none; /* Menghapus garis bawah dari tautan */
            font-weight: bold; /* Teks tebal */
            transition: background-color 0.3s; /* Transisi halus untuk efek hover */
        }
        .logout-button:hover {
            background-color: #c53030; /* Merah lebih gelap saat hover */
        }
        .form-container {
            background-color: #2d3748; /* Warna latar belakang untuk form */
            padding: 20px; /* Padding di sekitar form */
            border-radius: 10px; /* Sudut membulat */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Bayangan halus untuk kedalaman */
        }
        .input-field {
            background-color: #ffffff; /* Warna latar belakang untuk input */
            color: #000000; /* Warna teks hitam untuk input */
        }
        .input-field::placeholder {
            color: #a0aec0; /* Warna placeholder */
        }
        .submenu-title, .submenu-link {
            background-color: #ffffff; /* Warna latar belakang untuk input submenu */
            color: #000000; /* Warna teks hitam untuk input submenu */
        }
        .submenu-title::placeholder, .submenu-link::placeholder {
            color: #a0aec0; /* Warna placeholder untuk submenu */
        }
        .button {
            transition: background-color 0.3s; /* Transisi halus untuk efek hover */
        }
        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            max-width: 300px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .modal-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .modal-buttons .btn-top {
            background-color: #4CAF50;
            color: white;
        }
        .modal-buttons .btn-top:hover {
            background-color: #45a049;
        }
        .modal-buttons .btn-bottom {
            background-color: #008CBA;
            color: white;
        }
        .modal-buttons .btn-bottom:hover {
            background-color: #007bb5;
        }
        /* Modal Text Color */
        .modal-content p {
            color: black; /* Warna hitam untuk teks dalam modal */
        }
        /* Scroll to Top Button */
        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s;
            z-index: 1000;
        }
        .scroll-to-top:hover {
            background-color: #0056b3;
        }
        .scroll-to-top i {
            font-size: 1.5rem;
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen">

    <div class="container mx-auto p-10 fade-in">
        <h1 class="text-5xl font-extrabold text-center text-indigo-300 mb-10">DASHBOARD</h1>
        <div class="dashboard-container">
            <p>Kamu Berhasil Login Sebagai <?php echo $_SESSION['username']; ?></p>
            <a href="logout.php" class="logout-button">Logout</a>
        </div>

        <div class="form-container bg-gray-800 p-10 rounded-lg shadow-lg border border-gray-700 slide-in">
            <form id="menuForm" class="space-y-8">
                <div class="mb-6">
                    <label for="menuTitle" class="form-label text-lg font-medium text-gray-300">Nama Menu *</label>
                    <input type="text" id="menuTitle" class="input-field p-3 rounded-lg border-2 border-gray-600 w-full mt-2 text-base transition duration-300 focus:border-blue-500" placeholder="Masukkan nama menu" required>
                </div>
                <div class="mb-6">
                    <label for="menuLink" class="form-label text-lg font-medium text-gray-300">Link URL Menu</label>
                    <input type="url" id="menuLink" class="input-field p-3 rounded-lg border-2 border-gray-600 w-full mt-2 text-base transition duration-300 focus:border-blue-500" placeholder="http://">
                </div>

                <div id="subMenuContainer" class="space-y-6">
                    <div class="submenu-item bg-gray-700 p-5 rounded-lg shadow-sm mt-4 slide-in">
                        <div class="mb-4">
                            <label class="form-label text-lg font-medium text-gray-300">Nama Submenu *</label>
                            <input type="text" class="submenu-title p-3 rounded-lg border-2 border-gray-600 w-full mt-2 text-base transition duration-300 focus:border-blue-500" placeholder="Masukkan nama submenu" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-lg font-medium text-gray-300">Link Submenu *</label>
                            <input type="url" class="submenu-link p-3 rounded-lg border-2 border-gray-600 w-full mt-2 text-base transition duration-300 focus:border-blue-500" placeholder="http://" required>
                        </div>

                        <button type="button" class="delete-btn bg-red-500 text-white p-2 rounded-lg font-semibold mt-3 transition duration-300 hover:bg-red-600 flex items-center" onclick="deleteSubMenu(this)">
                            <i class="fas fa-trash-alt mr-2"></i>Hapus Submenu
                        </button>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-16">
                    <button type="button" onclick="showPositionModal()" class="button add-btn bg-blue-500 text-white p-2 rounded-lg font-semibold flex items-center transition duration-300 hover:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Submenu
                    </button>
                    <button type="submit" class="button save-btn bg-green-500 text-white p-2 rounded-lg font-semibold flex items-center transition duration-300 hover:bg-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Menu
                    </button>
                    <button type="button" id="cancelBtn" class="cancel-btn bg-gray-600 text-white p-2 rounded-lg font-semibold transition duration-300 hover:bg-gray-500" style="display: none;" onclick="cancelEdit()">Batal</button>
                </div>
            </form>
        </div>

        <div class="mt-8">
            <h2 class="text-3xl font-bold text-indigo-300">Menu Tersimpan</h2>
            <div id="savedMenusContainer" class="space-y-4 mt-4"></div>
        </div>
    </div>

    <!-- Modal untuk Tambah Submenu -->
    <div id="positionModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePositionModal()">&times;</span>
            <p>Mau dimana?</p>
            <div class="modal-buttons">
                <button class="btn-top" onclick="addSubMenu('atas')">Paling Atas</button>
                <button class="btn-bottom" onclick="addSubMenu('bawah')">Paling Bawah</button>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Menu -->
    <div id="deleteMenuModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeDeleteMenuModal()">&times;</span>
            <p>Apakah Kamu yakin ingin menghapus menu ini?</p>
            <div class="modal-buttons">
                <button class="btn-top" id="confirmDeleteBtn">Ya, Hapus</button>
                <button class="btn-bottom" onclick="closeDeleteMenuModal()">Batal</button>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="scroll-to-top" onclick="scrollToTop()">
        <i class="fas fa-arrow-up"></i>
    </button>

    <footer class="w-full bg-gray-800 text-white py-4 mt-10">
        <div class="container mx-auto text-center">
            <p>Copyright &copy; 2024 Ryan Tomi Alfrianto</p>
        </div>
    </footer>

    <script>
        let menuData = JSON.parse(localStorage.getItem('menuData')) || [];
        let menuIdToDelete = null; // Variabel untuk menyimpan ID menu yang akan dihapus

        document.getElementById('menuForm').onsubmit = async function (event) {
            event.preventDefault();

            const title = document.getElementById('menuTitle').value;
            const link = document.getElementById('menuLink').value;
            const subItems = Array.from(document.querySelectorAll('.submenu-item')).map(subItem => ({
                title: subItem.querySelector('.submenu-title').value,
                link: subItem.querySelector('.submenu-link').value,
            }));

            const saveButton = document.querySelector('.save-btn');
            const isUpdate = saveButton.innerHTML === 'Perbarui Menu';
            let menuId = null;

            // Jika ini adalah pembaruan, ambil ID menu dari data yang ada
            if (isUpdate) {
                const index = saveButton.getAttribute('data-index');
                menuId = menuData[index].id; // Ambil ID menu dari menuData
            }

            try {
                const response = await fetch('api.php' + (isUpdate ? `?id=${menuId}` : ''), {
                    method: isUpdate ? 'PUT' : 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: menuId, title, link, subItems }), // Sertakan ID di sini
                });
                const data = await response.json();
                alert(data.message);
                loadSavedMenus();
                resetForm();
            } catch (error) {
                console.error('Error:', error);
            }
        };

        function showPositionModal() {
            document.getElementById('positionModal').style.display = 'block';
        }

        function closePositionModal() {
            document.getElementById('positionModal').style.display = 'none';
        }

        function addSubMenu(position) {
            closePositionModal();

            const container = document.getElementById('subMenuContainer');
            const div = document.createElement('div');
            div.className = 'submenu-item bg-gray-700 p-5 rounded-lg shadow-sm mt-4 slide-in';
            div.innerHTML = `
                <div class="mb-4">
                    <label class="form-label text-lg font-medium text-gray-300">Nama Submenu *</label>
                    <input type="text" class="submenu-title p-3 rounded-lg border-2 border-gray-600 w-full mt-2 text-base transition duration-300 focus:border-blue-500" placeholder="Masukkan nama submenu" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-lg font-medium text-gray-300">Link Submenu *</label>
                    <input type="url" class="submenu-link p-3 rounded-lg border-2 border-gray-600 w-full mt-2 text-base transition duration-300 focus:border-blue-500" placeholder="http://" required>
                </div>

                <button type="button" class="delete-btn bg-red-500 text-white p-2 rounded-lg font-semibold mt-3 transition duration-300 hover:bg-red-600 flex items-center" onclick="deleteSubMenu(this)">
                    <i class="fas fa-trash-alt mr-2"></i>Hapus Submenu
                </button>
            `;

            if (position === 'atas') {
                container.insertBefore(div, container.firstChild);
            } else {
                container.appendChild(div);
            }
        }

        function editMenu(index) {
            const menu = menuData[index]; // Ambil menu berdasarkan index
            if (!menu) {
                console.error('Menu tidak ditemukan');
                return; // Jika menu tidak ditemukan, keluar dari fungsi
            }
            
            document.getElementById('menuTitle').value = menu.title;
            document.getElementById('menuLink').value = menu.link || '';
            document.getElementById('subMenuContainer').innerHTML = menu.submenus.map(subItem => `
                <div class="submenu-item bg-gray-700 p-5 rounded-lg shadow-sm mt-4 slide-in">
                    <div class="mb-4">
                        <label class="form-label text-lg font-medium text-gray-300">Nama Submenu *</label>
                        <input type="text" class="submenu-title p-3 rounded-lg border-2 border-gray-600 w-full mt-2 text-base transition duration-300 focus:border-blue-500" value="${subItem.title}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-lg font-medium text-gray-300">Link Submenu *</label>
                        <input type="url" class="submenu-link p-3 rounded-lg border-2 border-gray-600 w-full mt-2 text-base transition duration-300 focus:border-blue-500" value="${subItem.link}" required>
                    </div>

                    <button type="button" class="delete-btn bg-red-500 text-white p-2 rounded-lg font-semibold mt-3 transition duration-300 hover:bg-red-600 flex items-center" onclick="deleteSubMenu(this)">
                        <i class="fas fa-trash-alt mr-2"></i>Hapus Submenu
                    </button>
                </div>
            `).join('');

            const saveButton = document.querySelector('.save-btn');
            saveButton.innerHTML = 'Perbarui Menu';
            saveButton.setAttribute('data-index', index); // Simpan index untuk pembaruan
            document.getElementById('cancelBtn').style.display = 'inline-block';

            // Scroll ke atas
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function deleteSubMenu(button) {
            const submenuItem = button.parentElement;
            submenuItem.remove();
        }

        async function deleteMenu(id) {
            menuIdToDelete = id; // Simpan ID menu yang akan dihapus
            document.getElementById('deleteMenuModal').style.display = 'block'; // Tampilkan modal konfirmasi
        }

        function closeDeleteMenuModal() {
            document.getElementById('deleteMenuModal').style.display = 'none'; // Sembunyikan modal konfirmasi
        }

        document.getElementById('confirmDeleteBtn').onclick = async function() {
            if (menuIdToDelete) {
                try {
                    const response = await fetch(`api.php?id=${menuIdToDelete}`, {
                        method: 'DELETE',
                    });
                    const data = await response.json();
                    alert(data.message);
                    loadSavedMenus();
                    closeDeleteMenuModal(); // Tutup modal setelah penghapusan
                } catch (error) {
                    console.error('Error:', error);
                }
            }
        };

        async function loadSavedMenus() {
            try {
                const response = await fetch('api.php');
                const menus = await response.json();
                const savedMenusContainer = document.getElementById('savedMenusContainer');
                savedMenusContainer.innerHTML = '';
                menuData = menus; // Simpan data menu ke dalam menuData

                menus.forEach((menu, index) => {
                    const menuDiv = document.createElement('div');
                    menuDiv.className = 'saved-menu bg-gray-800 p-6 rounded-lg shadow-md transition duration-300 hover:shadow-lg slide-in';
                    menuDiv.innerHTML = `
                        <h3 class="saved-menu-title text-xl font-semibold text-blue-300 mb-3">${menu.title}</h3>
                        ${menu.link ? `<a href="${menu.link}" class="text-blue-400 hover:underline mb-3 block">${menu.link}</a>` : ''}
                        <ul class="saved-menu-items list-disc pl-5">
                            ${menu.submenus.map(subItem => `
                                <li class="mb-2 text-base text-gray-300">
                                    <a href="${subItem.link}" class="text-blue-400 hover:underline">${subItem.title}</a>
                                </li>
                            `).join('')}
                        </ul>
                        <div class="flex space-x-2 mt-4">
                            <button type="button" class="saved-menu-delete bg-red-500 text-white p-2 rounded-lg font-semibold transition duration-300 hover:bg-red-600 flex items-center" onclick="deleteMenu(${menu.id})">
                                <i class="fas fa-trash-alt mr-2"></i>Hapus Menu
                            </button>
                            <button type="button" class="update-btn bg-yellow-500 text-white p-2 rounded-lg font-semibold transition duration-300 hover:bg-yellow-600 flex items-center" onclick="editMenu(${index})">
                                <i class="fas fa-pencil-alt mr-2"></i>Edit Menu
                            </button>
                        </div>
                    `;
                    savedMenusContainer.appendChild(menuDiv);
                });
            } catch (error) {
                console.error('Error:', error);
            }
        }

        function cancelEdit() {
            resetForm();
        }

        function resetForm() {
            document.getElementById('menuForm').reset();
            document.getElementById('subMenuContainer').innerHTML = `
                <div class="submenu-item bg-gray-700 p-5 rounded-lg shadow-sm mt-4 slide-in">
                    <div class="mb-4">
                        <label class="form-label text-lg font-medium text-gray-300">Nama Submenu *</label>
                        <input type="text" class="submenu-title p-3 rounded-lg border-2 border-gray-600 w-full mt-2 text-base transition duration-300 focus:border-blue-500" placeholder="Masukkan nama submenu" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-lg font-medium text-gray-300">Link Submenu *</label>
                        <input type="url" class="submenu-link p-3 rounded-lg border-2 border-gray-600 w-full mt-2 text-base transition duration-300 focus:border-blue-500" placeholder="http://" required>
                    </div>

                    <button type="button" class="delete-btn bg-red-500 text-white p-2 rounded-lg font-semibold mt-3 transition duration-300 hover:bg-red-600 flex items-center" onclick="deleteSubMenu(this)">
                        <i class="fas fa-trash-alt mr-2"></i>Hapus Submenu
                    </button>
                </div>
            `;
            const saveButton = document.querySelector('.save-btn');
            saveButton.innerHTML = 'Simpan Menu';
            saveButton.removeAttribute('data-index'); // Reset data-index
            document.getElementById('cancelBtn').style.display = 'none'; // Hide cancel button
        }

        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Menampilkan tombol scroll to top saat menggulir
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            const scrollToTopButton = document.getElementById('scrollToTop');
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                scrollToTopButton.style.display = 'block';
            } else {
                scrollToTopButton.style.display = 'none';
            }
        }

        loadSavedMenus();
    </script>

</body>
</html>
