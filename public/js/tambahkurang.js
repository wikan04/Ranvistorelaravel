let tambah = document.querySelectorAll('.plus');
let kurang = document.querySelectorAll('.mins');
let hitung = document.querySelectorAll('.count');
let hargaAwal = [];
let hargaEl = document.querySelectorAll('.harga');

hargaEl.forEach((element, index) => {
    let harga = element.textContent;
    harga = harga.replace(',', '');
    hargaAwal.push(parseInt(harga));
});
console.log(hargaAwal);


tambah.forEach((element, index) => {
    element.onclick = function () {
        let hitungTambah = parseInt(hitung[index].value) + 1;
        hitung[index].value = hitungTambah;
        let hargaEl = document.querySelectorAll('.harga')[index];
        let harga = hargaAwal[index] * hitungTambah;
        harga = harga.toString();
        let loopharga = '';
        for (let i = harga.length - 1; i >= 0; i--) {
            //1000000
            loopharga = loopharga + harga[harga.length - i - 1];
            if (i % 3 == 0 && i != 0) {
                loopharga = loopharga + ',';
            }
        }
        hargaEl.textContent = loopharga;
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

    }
});

hitung.forEach((element, index) => {
    element.onchange = function () {
        // console.log(element.value);
        // hargaEl[index].textContent = element.value * hargaAwal[index];
        // console.log(hargaEl[index]);

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
    }
});
