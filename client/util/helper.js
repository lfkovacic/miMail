const uploadFile = (filename, extension, blob) => {
    return 0;
}


export function fileDownload(file, fileName) {
    const data = base64ToArrayBuffer(file); // Create Uint8Array from base64 data

    const blob = new Blob([data]); //Iz dekodiranog polja radi novi BLOB
    let link = document.createElement("a");
    link.href = window.URL.createObjectURL(blob);
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

export function getValueFromInput(id) {
        console.log (id);
        const input = document.getElementById (id);
        return input.value;
    }

