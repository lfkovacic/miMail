export const uploadFile = async (filename, extension, file) => {
    if (file == null || file == undefined) throw new Error("Greška kod učitavanja, molimo ne pre velike datoteke!");
    return new Promise((resolve, reject) => {
        var reader = new FileReader();
        let arrayBuffer;
        reader.onload = async (e) => {
            arrayBuffer = e.target.result;
            const str = arrayBufferToBase64(arrayBuffer);
            resolve(str);
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
    const binaryLen = binaryString.length;
    const buffer = new ArrayBuffer(binaryLen);

    for (const byte of new TextEncoder('ascii').encode(base64)) {
        buffer.push(byte);
    }

    return buffer;
}


function arrayBufferToBase64(arrB) {
    const chunkSize = 1024; // Adjust the chunk size as needed
    const bytes = new Uint8Array(arrB);
    let base64Str = '';

    for (let i = 0; i < bytes.length; i += chunkSize) {
        const chunk = bytes.subarray(i, i + chunkSize);
        const str = new TextDecoder('ascii').decode(chunk);
        console.log(str);
        base64Str += window.btoa(str);
    }
    console.log(base64Str);

    return base64Str;
}

export function getValueFromInput(id) {
    console.log(id);
    const input = document.getElementById(id);
    console.log(document.childNodes);
    console.log(document.getElementById(id));
    console.log(document.getElementById("input-recipient"));
    console.log(input);
    console.log(input.value);
    return input.value;
}

export const createXMLNode = (name, attributes) => {
    const node = document.createElement(name);
    for (const key in attributes) {
        node.setAttribute(key, attributes[key]);
    }
    return node;
}
