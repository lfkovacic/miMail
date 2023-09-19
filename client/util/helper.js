export const uploadFile = async (filename, extension, file) => {
    if (file == null || file == undefined) throw new Error("Greška kod učitavanja, molimo ne pre velike datoteke!");
    return new Promise((resolve, reject) => {
        var reader = new FileReader();
        let arrayBuffer;
        reader.onload = async (e) => {
            arrayBuffer = e.target.result;
            const str = arrayBufferToBase64(arrayBuffer);
            resolve(str)
        }
        reader.onerror = (err) => {
            reject(err);
        }
        reader.readAsArrayBuffer(file);
    })
}

export const getImageFromBase64String = (base64_str) => {
    console.log(window.URL.createObjectURL(new Blob([base64ToArrayBuffer(base64_str)])));
    return window.URL.createObjectURL(new Blob([base64ToArrayBuffer(base64_str)]));
}

export function fileDownload(file, fileName) {
    let link = document.createElement("a");
    link.href = window.URL.createObjectURL(new Blob([base64ToArrayBuffer(file)]));
    link.download = fileName;
    link.click();
}

function base64ToArrayBuffer(base64) {
    const chunkSize = 1024; // Adjust the chunk size as needed
    const binaryString = window.atob(base64);
    const binaryLen = binaryString.length;
    const buffer = new ArrayBuffer(binaryLen);
    const bytes = new Uint8Array(buffer);

    for (let i = 0; i < binaryLen; i += chunkSize) {
        const end = Math.min(i + chunkSize, binaryLen);
        for (let j = i; j < end; j++) {
            bytes[j] = binaryString.charCodeAt(j);
        }
    }

    return buffer;
}


function arrayBufferToBase64(arrB) {
    const chunkSize = 1024; // Adjust the chunk size as needed
    const bytes = new Uint8Array(arrB);
    let base64Str = '';

    for (let i = 0; i < bytes.length; i += chunkSize) {
        const chunk = bytes.subarray(i, i + chunkSize);
        const chunkStr = String.fromCharCode.apply(null, chunk);
        base64Str += btoa(chunkStr);
    }

    return base64Str;
}

export function getValueFromInput(id) {
    console.log(id);
    const input = document.getElementById(id);
    return input.value;
}



