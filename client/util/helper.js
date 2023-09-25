export const uploadFile = async (filename, extension, file) => {
    if (file == null || file == undefined) throw new Error("Greška kod učitavanja, molimo ne pre velike datoteke!");
    return new Promise((resolve, reject) => {
        var reader = new FileReader();
        let arrayBuffer;
        reader.onload = async (e) => {
            arrayBuffer = e.target.result;
            const str = await arrayBufferToBase64(arrayBuffer);
            resolve(str);
        }
        reader.onerror = (err) => {
            reject(err);
        }
        reader.readAsArrayBuffer(file);
    })
}

export const getImageFromBase64String = (base64Str) => {
    const src = window.URL.createObjectURL(
        new Blob([base64ToArrayBuffer(base64Str)])
    );
    return src;
}

export function fileDownload(file, fileName) {
    let link = document.createElement("a");
    link.href = window.URL.createObjectURL(new Blob([base64ToArrayBuffer(file)]));
    link.download = fileName;
    link.click();
}

function base64ToArrayBuffer(base64Str) {
    var binary = atob(base64Str);
    var bytes = new Uint8Array(binary.length);
    for (var i = 0; i<binary.length; i++) bytes[i] = binary.charCodeAt(i);
    return bytes.buffer;
}


// note: `buffer` arg can be an ArrayBuffer or a Uint8Array
async function arrayBufferToBase64(buffer) {
    // use a FileReader to generate a base64 data URI:
    const base64url = await new Promise(r => {
        const reader = new FileReader()
        reader.onload = () => r(reader.result)
        reader.readAsDataURL(new Blob([buffer]))
    });
    // remove the `data:...;base64,` part from the star
    const base64Str = base64url.slice(base64url.indexOf(',') + 1);
    return base64Str;
}

export function getValueFromInput(id) {
    const input = document.getElementById(id);
    return input.value;
}

export const createXMLNode = (name, attributes) => {
    const node = document.createElement(name);
    for (const key in attributes) {
        node.setAttribute(key, attributes[key]);
    }
    return node;
}
