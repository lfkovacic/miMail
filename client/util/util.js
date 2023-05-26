

export const getRandomInt = (max) => {
    return Math.floor(Math.random() * max);
}

export const getRandomChar = () => {
    return String.fromCharCode(getRandomInt('h'.charCodeAt() - 'a'.charCodeAt()) + 'a'.charCodeAt());
}


export const generateSHA256Hash =(data) => {
    const encoder = new TextEncoder();
    const dataBuffer = encoder.encode(data);
  
    return window.crypto.subtle.digest('SHA-256', dataBuffer).then(hashBuffer => {
      const hashArray = Array.from(new Uint8Array(hashBuffer));
      const hashHex = hashArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
      return hashHex;
    });
}