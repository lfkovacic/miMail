export const uploadFile = (filename, extension, file) => {
    var reader = new FileReader();
    let arrayBuffer;
    reader.onload = (e) => {
        arrayBuffer = e.target.result;
        console.log("BUFFER");
        console.log(arrayBuffer);
        console.log(arrayBufferToBase64(arrayBuffer));
    }
    reader.readAsArrayBuffer(file)
    const str = arrayBufferToBase64(arrayBuffer);
    return str;
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

function arrayBufferToBase64(arrB) {
    console.log(arrB);
    const uint8Array = new Uint8Array(arrB);
    console.log(uint8Array);
    console.log(btoa(String.fromCharCode.apply(null, uint8Array)));
    const base64Str = btoa(String.fromCharCode.apply(null, uint8Array));
    console.log(base64Str);
    return base64Str;
}

export function getValueFromInput(id) {
    console.log(id);
    const input = document.getElementById(id);
    return input.value;
}

