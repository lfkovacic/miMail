export class XML {


    constructor(meta) {
        this.root = createNewDocument(meta);
    }

    static createNewDocument(meta) {
        const xml = document.implementation.createDocument("", "", null);
        let metaStr = '';
        console.log(meta);
        for (const key in meta) {
            metaStr += `${key}="${meta[key]}" `;
            console.log(metaStr);
        }
        let xmlDeclaration = xml.createProcessingInstruction("xml", metaStr);
        xml.appendChild(xmlDeclaration);
        console.log(xml);

        return xml;
    }

    static createNode(name, attributes, text) {
        const node = document.createElement(name);
        if (attributes !== null)
            for (const key in attributes) {
                node.setAttribute(key, attributes[key]);
            }
        if (text !== null)
            node.textContent = text;
        return node;
    }

    static getTextContent(node) {
        return new XMLSerializer().serializeToString(node);
    }
}