<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
	<title>Welcome to WEBSEI</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<style>
		#overlay {
            display: none;
        }
	</style>
	<script>
        document.addEventListener('DOMContentLoaded', function() {
            const proyekSection = document.getElementById('proyek-section');
            const lokasiSection = document.getElementById('lokasi-section');
            const proyekButton = document.getElementById('proyek-button');
            const lokasiButton = document.getElementById('lokasi-button');
            const modalCloseButtons = document.querySelectorAll('[data-modal-close]');
            const modalOpenButtons = document.querySelectorAll('[data-modal-open]');
            
            proyekButton.addEventListener('click', function() {
                proyekSection.classList.remove('hidden');
                lokasiSection.classList.add('hidden');
                lokasiButton.classList.remove('bg-[#47AF36]', 'text-white', 'hover:bg-[#47AF36]/80');
                lokasiButton.classList.add('bg-white', 'text-black', 'hover:bg-gray-300');
                proyekButton.classList.remove('bg-white', 'text-black', 'hover:bg-gray-300');
                proyekButton.classList.add('bg-[#47AF36]', 'text-white');
            });

            lokasiButton.addEventListener('click', function() {
                lokasiSection.classList.remove('hidden');
                proyekSection.classList.add('hidden');
                proyekButton.classList.remove('bg-[#47AF36]', 'text-white', 'hover:bg-[#47AF36]/80');
                proyekButton.classList.add('bg-white', 'text-black', 'hover:bg-gray-300');
                lokasiButton.classList.remove('bg-white', 'text-black', 'hover:bg-gray-300');
                lokasiButton.classList.add('bg-[#47AF36]', 'text-white', 'hover:bg-[#47AF36]/80');
            });

            modalOpenButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetModal = document.getElementById(this.dataset.modalTarget);
                    targetModal.classList.remove('hidden');
                });
            });
			
            modalCloseButtons.forEach(button => {
				button.addEventListener('click', function() {
					this.closest('.modal').classList.add('hidden');
                });
            });
        });
		</script>
</head>
<body>
	<div id="container" class="w-full relative bg-white overflow-hidden flex flex-col items-center justify-start pt-[16px] px-5 box-border gap-[35px] leading-[normal] tracking-[normal] mq750:gap-[17px]">
		<header class="w-full flex flex-row items-start justify-between max-w-full text-center text-base text-white font-poppins px-10">
			<img class="w-32 h-16" src="http://localhost/websei/assets/images/sei.png" alt="sei">
			<div class="flex flex-row justify-self-end gap-5 bg-[#47AF36] self-center rounded-tl-full rounded-br-full px-10 py-2 text-lg font-semibold">
				<a href="#">Beranda</a>
				<a href="#">Tentang Kami</a>
				<a href="#">Bisnis Kami</a>
				<a href="#">Produk Kami</a>
				<a href="#">Pengalaman Kami</a>
				<a href="#">Media</a>
				<a href="#">Karir</a>
			</div>
		</header>
		<div class="w-full flex flex-row items-start max-w-full text-center text-base font-poppins px-10 gap-3">
			<button class="bg-[#47AF36] text-white hover:bg-[#47AF36]/80 rounded-md px-3 py-2" id="proyek-button" type="button">Daftar Proyek</button>
			<button class="bg-white text-black hover:bg-gray-300 rounded-md px-3 py-2" id="lokasi-button" type="button">Daftar Lokasi</button>
		</div>
		<div id="proyek-section" class="w-full">
			<div class="w-full flex flex-row items-start justify-between max-w-full text-center text-base font-poppins px-10 gap-3">
				<div class="text-xl font-bold self-center">Proyek</div>
                <button class="bg-[#47AF36] rounded-br-full rounded-tl-full text-white flex flex-row text-md px-6 py-2 gap-1" type="button" data-modal-target="add-proyek-modal" data-modal-open><img class="self-center" src="http://localhost/websei/assets/images/adding.jpg" alt="adding">Tambahkan Proyek</button>
            </div>
            <section class="w-full px-10 mt-3 grid grid-cols-4 gap-3">
				<?php foreach($projects as $p): ?>
                    <div class="min-w-60 min-h-40 border-2 border-black rounded-md">
						<div class="flex flex-row justify-end items-center mx-4 pt-4 gap-3">
							<button data-modal-target="edit-proyek-modal-<?php echo $p['id']; ?>" data-modal-open type="button"><img class="h-4" src="http://localhost/websei/assets/images/edit.png" alt="edit"></button>
                            <button data-modal-target="delete-proyek-modal-<?php echo $p['id']; ?>" data-modal-open type="button"><img class="h-4" src="http://localhost/websei/assets/images/delete.png" alt="delete"></button>
                        </div>
                        <div class="mx-4 pt-1 gap-3">
							<h2 class="text-md font-semibold"><?php echo $p['namaProyek']; ?></h2>
                            <h2 class="text-sm mt-2"><?php echo $p['tglMulai']; ?></h2>
                            <h2 class="text-sm mt-2"><?php echo $p['tglSelesai']; ?></h2>
                            <?php foreach ($p['lokasiList'] as $l): ?>
                                <h2 class="text-sm mt-2"><?php echo $l['namaLokasi']; ?></h2>
								<?php endforeach; ?>
							</div>
						</div>
						
						<!-- Edit Proyek Modal -->
						<div id="edit-proyek-modal-<?php echo $p['id']; ?>" class="modal fixed inset-0 flex items-center justify-center hidden">
							<div class="bg-white p-6 rounded-lg shadow-lg border-2 border-slate-400">
								<h2 class="text-xl font-semibold mb-4">Edit Proyek</h2>
								<!-- Form for editing proyek -->
								<form action="<?php echo site_url('proyek/edit'); ?>" method="post">
									<div class="flex flex-row gap-3">
										<div>
											<input type="hidden" name="id" value="<?php echo $p['id']; ?>">
											<label class="block mb-2">Nama Proyek</label>
											<input type="text" name="namaProyek" value="<?php echo $p['namaProyek']; ?>" class="border border-slate-500 p-2 rounded w-full mb-4">
											<label class="block mb-2">Client</label>
											<input type="text" name="client" value="<?php echo $p['client']; ?>" class="border border-slate-500 p-2 rounded w-full mb-4">
											<label class="block mb-2">Tanggal Mulai</label>
											<input type="date" name="tglMulai" value="<?php echo $p['tglMulai']; ?>" class="border border-slate-500 p-2 rounded w-full mb-4">
											<label class="block mb-2">Tanggal Selesai</label>
											<input type="date" name="tglSelesai" value="<?php echo $p['tglSelesai']; ?>" class="border border-slate-500 p-2 rounded w-full mb-4">
										</div>
										<div>
											<label class="block mb-2">Pimpinan Proyek</label>
											<input type="text" name="pimpinanProyek" value="<?php echo $p['pimpinanProyek']; ?>" class="border border-slate-500 p-2 rounded w-full mb-4">
											<label class="block mb-2">Keterangan</label>
											<input type="text" name="keterangan" value="<?php echo $p['keterangan']; ?>" class="border border-slate-500 p-2 rounded w-full mb-4">
											<label class="block mb-2">Lokasi</label>
											<select name="lokasiList[]" class="border border-slate-500 p-2 rounded w-full mb-4" multiple>
												<?php foreach ($lokasi as $location): ?>
													<option value="<?php echo $location['id']; ?>">
														<?php echo $location['namaLokasi'] . ' - ' . $location['kota'] . ', ' . $location['provinsi']; ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<button type="submit" class="bg-[#47AF36] text-white py-2 px-4 rounded">Update Proyek</button>
									<button type="button" data-modal-close class="bg-gray-300 text-black py-2 px-4 rounded ml-2">Close</button>
								</form>
							</div>
						</div>
						
						<!-- Delete Proyek Modal -->
						<div id="delete-proyek-modal-<?php echo $p['id']; ?>" class="modal fixed inset-0 flex items-center justify-center hidden">
							<div class="bg-white p-6 rounded-lg shadow-lg border-2 border-slate-400">
								<h2 class="text-xl font-semibold mb-4">Delete Proyek</h2>
								<p class="mb-4">Are you sure you want to delete this proyek?</p>
								<form action="<?php echo site_url('proyek/delete'); ?>" method="post">
									<input type="hidden" name="id" value="<?php echo $p['id']; ?>">
									<button type="submit" class="bg-red-600 text-white py-2 px-4 rounded">Delete</button>
									<button type="button" data-modal-close class="bg-gray-300 text-black py-2 px-4 rounded ml-2">Cancel</button>
								</form>
							</div>
						</div>
						<?php endforeach; ?>
					</section>
				</div>
				
				<!-- Lokasi Section -->
				<div id="lokasi-section" class="w-full hidden">
					<div class="w-full flex flex-row items-start justify-between max-w-full text-center text-base font-poppins px-10 gap-3">
						<div class="text-xl font-bold self-center">Lokasi</div>
						<button class="bg-[#47AF36] rounded-br-full rounded-tl-full text-white flex flex-row text-md px-6 py-2 gap-1" type="button" data-modal-target="add-lokasi-modal" data-modal-open><img class="self-center" src="http://localhost/websei/assets/images/adding.jpg" alt="adding">Tambahkan Lokasi</button>
					</div>
					<section class="w-full px-10 mt-3 grid grid-cols-4 gap-3">
						<?php foreach($lokasi as $l): ?>
							<div class="min-w-60 min-h-40 border-2 border-black rounded-md">
								<div class="flex flex-row justify-end items-center mx-4 pt-4 gap-3">
									<button data-modal-target="edit-lokasi-modal-<?php echo $l['id']; ?>" data-modal-open type="button"><img class="h-4" src="http://localhost/websei/assets/images/edit.png" alt="edit"></button>
									<button data-modal-target="delete-lokasi-modal-<?php echo $l['id']; ?>" data-modal-open type="button"><img class="h-4" src="http://localhost/websei/assets/images/delete.png" alt="delete"></button>
								</div>
								<div class="mx-4 pt-1 gap-3">
									<h2 class="text-md font-semibold"><?php echo $l['namaLokasi']; ?></h2>
									<h2 class="text-sm mt-2"><?php echo $l['negara']; ?></h2>
									<h2 class="text-sm mt-2"><?php echo $l['provinsi']; ?></h2>
									<h2 class="text-sm mt-2"><?php echo $l['kota']; ?></h2>
								</div>
							</div>
							
							<!-- Edit Lokasi Modal -->
							<div id="edit-lokasi-modal-<?php echo $l['id']; ?>" class="modal fixed inset-0 flex items-center justify-center hidden">
								<div class="bg-white p-6 rounded-lg shadow-lg border-2 border-slate-400">
									<h2 class="text-xl font-semibold mb-4">Edit Lokasi</h2>
									<!-- Form for editing lokasi -->
									<form action="<?php echo site_url('lokasi/edit'); ?>" method="post">
										<input type="hidden" name="id" value="<?php echo $l['id']; ?>">
										<label for="namaLokasi" class="block mb-2">Nama Lokasi</label>
										<input type="text" name="namaLokasi" value="<?php echo $l['namaLokasi']; ?>" class="border border-slate-500 p-2 rounded w-full mb-4">
										<label for="negara" class="block mb-2">Negara</label>
										<input type="text" name="negara" value="<?php echo $l['negara']; ?>" class="border border-slate-500 p-2 rounded w-full mb-4">
										<label for="provinsi" class="block mb-2">Provinsi</label>
										<input type="text" name="provinsi" value="<?php echo $l['provinsi']; ?>" class="border border-slate-500 p-2 rounded w-full mb-4">
										<label for="kota" class="block mb-2">Kota</label>
										<input type="text" name="kota" value="<?php echo $l['kota']; ?>" class="border border-slate-500 p-2 rounded w-full mb-4">
										<!-- Add more fields as needed -->
										<button type="submit" class="bg-[#47AF36] text-white py-2 px-4 rounded">Update Lokasi</button>
										<button type="button" data-modal-close class="bg-gray-300 text-black py-2 px-4 rounded ml-2">Close</button>
									</form>
								</div>
							</div>
							
							<!-- Delete Lokasi Modal -->
							<div id="delete-lokasi-modal-<?php echo $l['id']; ?>" class="modal fixed inset-0 flex items-center justify-center hidden">
								<div class="bg-white p-6 rounded-lg shadow-lg border-2 border-slate-400">
									<h2 class="text-xl font-semibold mb-4">Delete Lokasi</h2>
									<p class="mb-4">Are you sure you want to delete this lokasi?</p>
									<form action="<?php echo site_url('lokasi/delete'); ?>" method="post">
										<input type="hidden" name="id" value="<?php echo $l['id']; ?>">
										<button type="submit" class="bg-red-600 text-white py-2 px-4 rounded">Delete</button>
										<button type="button" data-modal-close class="bg-gray-300 text-black py-2 px-4 rounded ml-2">Cancel</button>
									</form>
								</div>
							</div>
							<?php endforeach; ?>
						</section>
					</div>
					
					<!-- Add Proyek Modal -->
					<div id="add-proyek-modal" class="modal fixed inset-0 flex items-center justify-center hidden">
						<div class="bg-white p-6 rounded-lg shadow-lg border-2 border-slate-400">
						<h2 class="text-xl font-semibold mb-4">Tambah Proyek</h2>
						<!-- Form for adding proyek -->
						<form action="<?php echo site_url('proyek/add'); ?>" method="post">
							<div class="flex flex-row gap-3">
								<div>
									<label class="block mb-2">Nama Proyek</label>
									<input type="text" name="namaProyek" class="border border-slate-500 p-2 rounded w-full mb-4">
									<label class="block mb-2">Client</label>
									<input type="text" name="client" class="border border-slate-500 p-2 rounded w-full mb-4">
									<label class="block mb-2">Tanggal Mulai</label>
									<input type="date" name="tglMulai" class="border border-slate-500 p-2 rounded w-full mb-4">
									<label class="block mb-2">Tanggal Selesai</label>
									<input type="date" name="tglSelesai" class="border border-slate-500 p-2 rounded w-full mb-4">
								</div>
								<div>
									<label class="block mb-2">Pimpinan Proyek</label>
									<input type="text" name="pimpinanProyek" class="border border-slate-500 p-2 rounded w-full mb-4">
									<label class="block mb-2">Keterangan</label>
									<input type="text" name="keterangan" class="border border-slate-500 p-2 rounded w-full mb-4">
									<label class="block mb-2">Lokasi</label>
									<select name="lokasiList[]" class="border border-slate-500 p-2 rounded w-full mb-4" multiple>
										<?php foreach ($lokasi as $location): ?>
											<option value="<?php echo $location['id']; ?>">
												<?php echo $location['namaLokasi'] . ' - ' . $location['kota'] . ', ' . $location['provinsi']; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<button type="submit" class="bg-[#47AF36] text-white py-2 px-4 rounded">Add Proyek</button>
							<button type="button" data-modal-close class="bg-gray-300 text-black py-2 px-4 rounded ml-2">Close</button>
						</form>
					</div>
				</div>
				
				<!-- Add Lokasi Modal -->
				<div id="add-lokasi-modal" class="modal fixed inset-0 flex items-center justify-center hidden">
					<div class="bg-white p-6 rounded-lg shadow-lg border-2 border-slate-400">
						<h2 class="text-xl font-semibold mb-4">Tambah Lokasi</h2>
						<!-- Form for adding lokasi -->
						<form action="<?php echo site_url('lokasi/add'); ?>" method="post">
							<label class="block mb-2">Nama Lokasi</label>
							<input type="text" name="namaLokasi" class="border border-slate-500 p-2 rounded w-full mb-4">
							<label class="block mb-2">Negara</label>
							<input type="text" name="negara" class="border border-slate-500 p-2 rounded w-full mb-4">
							<label class="block mb-2">Provinsi</label>
							<input type="text" name="provinsi" class="border border-slate-500 p-2 rounded w-full mb-4">
							<label class="block mb-2">Kota</label>
							<input type="text" name="kota" class="border border-slate-500 p-2 rounded w-full mb-4">
							<!-- Add more fields as needed -->
							<button type="submit" class="bg-[#47AF36] text-white py-2 px-4 rounded">Add Lokasi</button>
							<button type="button" data-modal-close class="bg-gray-300 text-black py-2 px-4 rounded ml-2">Close</button>
						</form>
					</div>
				</div>
	</div>
</body>
</html>
