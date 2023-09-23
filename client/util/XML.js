//Klasa za operacije s XML dokumentima

class XML {

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

    static toJson(node, obj) {
        if (obj.length < 1) obj = {};

        const nodeName = node.nodeName;
        obj[nodeName] = {};
        const nodeAttributes = node.attributes;
        obj[nodeName].attributes = nodeAttributes === undefined ? null: nodeAttributes;
        const nodeText = node.textContent;
        obj[nodeName].nodeText = nodeText === undefined ? null : nodeText;
        const nodeChildren = node.children;

        console.log(nodeName);
        console.log(nodeAttributes);
        console.log(nodeText);
        console.log(nodeChildren);

        if (node.children.length > 0)
            for (const child of nodeChildren) this.toJson(child, obj[nodeName]);

        return obj;

    }

    static parse(xmlStr){
        return new DOMParser().parseFromString(xmlStr, 'text/xml');
    }
}

export default XML;