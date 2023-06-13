
import { SOL } from "../consts/consts.js";

export const getRandomInt = (max) => {
    return Math.floor(Math.random() * max);
}

export const getRandomChar = (a, z) => {
    return String.fromCharCode(getRandomInt(z.charCodeAt() - a.charCodeAt()) + a.charCodeAt());
}


export const generateSHA256Hash = async (data) => {
    const encoder = new TextEncoder();
    const dataBuffer = encoder.encode(data);

    const hashBuffer = await window.crypto.subtle.digest('SHA-256', dataBuffer);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    const hashHex = hashArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
    return hashHex;
};

export const processPassword = async (password) => {
    const string = SOL + password + getRandomChar('a', 'z');
    return  await generateSHA256Hash(string);
}

export const getPasswordArray = async (password) => {
    const arr = [];
    for (let c = 'a'.charCodeAt(); c < 'z'.charCodeAt(); c++) {
        const string = SOL + password + String.fromCharCode(c);
        arr.push(await generateSHA256Hash(string));
    }
    return arr;
}