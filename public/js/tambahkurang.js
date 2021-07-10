let tambah = document.querySelectorAll('.plus');
let kurang = document.querySelectorAll('.mins');
let hitung = document.querySelectorAll('.count');
let hargaAwal = [];
let hargaEl = document.querySelectorAll('.harga');
let totalHarga = document.querySelector('#total');

hargaEl.forEach((element, index) => {
    let harga = element.textContent;
    harga = harga.replace(',', '');
    hargaAwal.push(parseInt(harga));
});

tambah.forEach((element, index) => {
    element.onclick = function () {
        let hitungTambah = parseInt(hitung[index].value) + 1;
        hitung[index].value = hitungTambah;
        let hargaEl = document.querySelectorAll('.harga')[index];
        let harga = hargaAwal[index] * hitungTambah;
        harga = harga.toString();
        let loopharga = '';
        for (let i = harga.length - 1; i >= 0; i--) {
            loopharga = loopharga + harga[harga.length - i - 1];

            if (i % 3 == 0 && i != 0) {
                loopharga = loopharga + ',';
            }
        }
        hargaEl.textContent = loopharga;
        hargaEl = document.querySelectorAll('.harga');
        nilaiAwalTotal = 0;
        hargaEl.forEach(element => {
            let hargaTotal = element.textContent;
            hargaTotal = hargaTotal.replace(',', '');
            hargaTotal = parseInt(hargaTotal);
            nilaiAwalTotal = hargaTotal + nilaiAwalTotal;
        });
        let loopharga2 = '';
        nilaiAwalTotal = nilaiAwalTotal.toString();
        for (let i = nilaiAwalTotal.length - 1; i >= 0; i--) {
            loopharga2 = loopharga2 + nilaiAwalTotal[nilaiAwalTotal.length - i - 1];
            if (i % 3 == 0 && i != 0) {
                loopharga2 = loopharga2 + ',';
            }
        }
        totalHarga.textContent = "Rp." + loopharga2;
    }
});


kurang.forEach((element, index) => {
    element.onclick = function () {

        if (parseInt(hitung[index].value) > 0) {
            hitung[index].value = parseInt(hitung[index].value) - 1;
            hitungKurang = (hitung[index].value);
            let hargaEl = document.querySelectorAll('.harga')[index];
            let harga = hargaAwal[index] * hitungKurang;
            harga = harga.toString();
            let loopharga = '';
            for (let i = harga.length - 1; i >= 0; i--) {
                loopharga = loopharga + harga[harga.length - i - 1];
                if (i % 3 == 0 && i != 0) {
                    loopharga = loopharga + ',';
                }
            }
            hargaEl.textContent = loopharga;
        }

        nilaiAwalTotal = 0;
        console.log(hargaEl);
        hargaEl.forEach(element => {
            let hargaTotal = element.textContent;
            hargaTotal = hargaTotal.replace(',', '');
            hargaTotal = parseInt(hargaTotal);
            nilaiAwalTotal = hargaTotal + nilaiAwalTotal;

        });
        let loopharga2 = '';
        nilaiAwalTotal = nilaiAwalTotal.toString();
        for (let i = nilaiAwalTotal.length - 1; i >= 0; i--) {
            loopharga2 = loopharga2 + nilaiAwalTotal[nilaiAwalTotal.length - i - 1];
            if (i % 3 == 0 && i != 0) {
                loopharga2 = loopharga2 + ',';
            }
        }
        totalHarga.textContent = "Rp." + loopharga2;
    }
});

hitung.forEach((element, index) => {
    element.onchange = function () {
        let harga = hargaAwal[index] * element.value;
        harga = harga.toString();
        let loopharga = '';
        for (let i = harga.length - 1; i >= 0; i--) {
            loopharga = loopharga + harga[harga.length - i - 1];
            if (i % 3 == 0 && i != 0) {
                loopharga = loopharga + ',';
            }
        }
        hargaEl[index].textContent = loopharga;

        nilaiAwalTotal = 0;
        hargaEl.forEach(element => {
            let hargaTotal = element.textContent;
            hargaTotal = hargaTotal.replace(',', '');
            hargaTotal = parseInt(hargaTotal);
            nilaiAwalTotal = hargaTotal + nilaiAwalTotal;

        });
        let loopharga2 = '';
        nilaiAwalTotal = nilaiAwalTotal.toString();
        for (let i = nilaiAwalTotal.length - 1; i >= 0; i--) {
            loopharga2 = loopharga2 + nilaiAwalTotal[nilaiAwalTotal.length - i - 1];
            if (i % 3 == 0 && i != 0) {
                loopharga2 = loopharga2 + ',';
            }
        }
        totalHarga.textContent = "Rp." + loopharga2;
    }
});
