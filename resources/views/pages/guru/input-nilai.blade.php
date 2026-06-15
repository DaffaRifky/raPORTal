@extends('pages.layout.layout')

@section('title', 'Input Nilai')
@section('header', 'Input Nilai')

@section('content')
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="col-span-3">
                <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" type="text" placeholder="Masukan Nama atau NIS">
            </div>
            <div>
                <label for="mp" class="block text-sm font-medium mb-1">Pilih Mata Pelajaran</label>
                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" id="mp" name="mata-pelajaran">
                    <option value="MTK">Matematika</option>
                    <option value="FIS">Fisika</option>
                </select>
            </div>
            <div>
                <label for="tugas" class="block text-sm font-medium mb-1">Pilih Tugas</label>
                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" id="tugas" name="tugas">
                    <option value="t1">Tugas 1</option>
                    <option value="t2">Tugas 2</option>
                    <option value="t3">Tugas 3</option>
                    <option value="ats">ATS</option>
                    <option value="t4">Tugas 4</option>
                    <option value="t5">Tugas 5</option>
                    <option value="t6">Tugas 6</option>
                    <option value="UAS">UAS</option>
                </select>
            </div>
            <div>
                <label for="kelas" class="block text-sm font-medium mb-1">Pilih Kelas</label>
                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" id="kelas" name="kelas">
                    <option value="10c">10-C</option>
                    <option value="11a">11-A</option>
                    <option value="11b">11-B</option>
                    <option value="12a">12-A</option>
                    <option value="12b">12-B</option>
                    <option value="12d">12-D</option>
                </select>
            </div>
        </div>
        <div class="border border-black/30 rounded-2xl overflow-hidden mb-4">
            <table class="table-auto w-full">
                <thead class="bg-[#D9D9D9]">
                    <tr>
                        <th class="text-start px-4 py-3 font-semibold">NIS</th>
                        <th class="text-start px-4 py-3 font-semibold">Nama Siswa</th>
                        <th class="text-start px-4 py-3 font-semibold">Nilai</th>
                        <th class="px-4 py-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="student-list" class="divide-y divide-black/10">
                    <!-- Content loaded via JavaScript -->
                </tbody>
            </table>
        </div>
        <div class="flex flex-row gap-2">
                <a href="" class="border border-black/30 p-2 rounded-xl w-10 text-center bg-[#E9E9EB]">◁</a>
                <a href="" class="border border-black/30 p-2 rounded-xl w-10 text-center bg-[#E9E9EB]">1</a>
                <a href="" class="border border-black/30 p-2 rounded-xl w-10 text-center bg-[#E9E9EB]">2</a>
                <a href="" class="border border-black/30 p-2 rounded-xl w-10 text-center bg-[#E9E9EB]">3</a>
                <a href="" class="border border-black/30 p-2 rounded-xl w-10 text-center bg-[#E9E9EB]">▷</a>
        </div>

    <script>
        const studentData = {
            '10c': [
                { nis: '10-10001', name: 'Alice Wonderland' },
                { nis: '10-10002', name: 'Bob Builder' },
                { nis: '10-10003', name: 'Charlie Chaplin' }
            ],
            '11a': [
                { nis: '11-20001', name: 'Dewi Sartika' },
                { nis: '11-20002', name: 'Eko Prasetyo' },
                { nis: '11-20003', name: 'Farah Quinn' }
            ],
            '11b': [
                { nis: '11-30001', name: 'Gading Marten' },
                { nis: '11-30002', name: 'Hamish Daud' }
            ],
            '12a': [
                { nis: '12-40001', name: 'Indra Herlambang' },
                { nis: '12-40002', name: 'Joko Anwar' }
            ],
            'default': [
                { nis: '12-12301', name: 'Aditya Pratama' },
                { nis: '12-12302', name: 'Budi Santoso' },
                { nis: '12-12303', name: 'Citra Lestari' }
            ]
        };

        const kelasSelect = document.getElementById('kelas');
        const studentTableBody = document.getElementById('student-list');

        function renderStudents(classId) {
            const students = studentData[classId] || studentData['default'];
            studentTableBody.innerHTML = '';

            students.forEach(student => {
                const row = `
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3">${student.nis}</td>
                        <td class="px-4 py-3 uppercase">${student.name}</td>
                        <td class="px-4 py-3">
                            <span class="nilai-text">100</span>
                            <input type="number" class="nilai-input hidden w-20 px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-200" value="100">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button class="edit-btn bg-amber-400 hover:bg-amber-500 text-white px-4 py-1 rounded-lg transition-colors text-sm font-medium">Edit</button>
                            <div class="save-actions hidden flex gap-2 justify-center">
                                <button class="save-btn bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg transition-colors text-sm font-medium">Simpan</button>
                                <button class="cancel-btn bg-gray-400 hover:bg-gray-500 text-white px-3 py-1 rounded-lg transition-colors text-sm font-medium">Batal</button>
                            </div>
                        </td>
                    </tr>`;
                studentTableBody.insertAdjacentHTML('beforeend', row);
            });
        }

        // Initial load
        renderStudents(kelasSelect.value);

        // Change listener for dropdown
        kelasSelect.addEventListener('change', (e) => {
            renderStudents(e.target.value);
        });

        // Event Delegation for Table Actions
        studentTableBody.addEventListener('click', (e) => {
            const row = e.target.closest('tr');
            if (!row) return;

            if (e.target.classList.contains('edit-btn')) {
                toggleRow(row, true);
            } else if (e.target.classList.contains('save-btn')) {
                const text = row.querySelector('.nilai-text');
                const input = row.querySelector('.nilai-input');
                text.textContent = input.value;
                toggleRow(row, false);
            } else if (e.target.classList.contains('cancel-btn')) {
                toggleRow(row, false);
            }
        });

        function toggleRow(row, isEditing) {
            const text = row.querySelector('.nilai-text');
            const input = row.querySelector('.nilai-input');
            const editBtn = row.querySelector('.edit-btn');
            const saveActions = row.querySelector('.save-actions');

            text.classList.toggle('hidden', isEditing);
            input.classList.toggle('hidden', !isEditing);
            editBtn.classList.toggle('hidden', isEditing);
            saveActions.classList.toggle('hidden', !isEditing);

            if (isEditing) input.focus();
        }
    </script>

@endsection
