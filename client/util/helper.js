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


export function fileDownload(file, fileName) {
    let link = document.createElement("a");
    link.href = window.URL.createObjectURL(new Blob([base64ToArrayBuffer(file)]));
    link.download = fileName;
    link.click();
}

function base64ToArrayBuffer(base64) {
    const binaryString = window.atob(base64); //Iz binarnog pretvara u 64-bitni zapis
    const binaryLen = binaryString.length;
    let bytes = new Uint8Array(binaryLen);
    for (let i = 0; i < binaryLen; i++) {
        const ascii = binaryString.charCodeAt(i); //1 po 1 prevodi u ASCII
        bytes[i] = ascii;
    }
    return bytes;
}

function arrayBufferToBase64(arrB) {
    let base64Str = btoa(String.fromCharCode.apply(null, new Uint8Array(arrB)));
    return base64Str;
}

export function getValueFromInput(id) {
    console.log(id);
    const input = document.getElementById(id);
    return input.value;
}

