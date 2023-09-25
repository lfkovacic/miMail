import XML from "../util/XML.js";
import { remoteService } from "./remoteService.js";

const soapService = {};

soapService.sendRequest = async function (method, url, data, headers) {

    //Instanciraj novi XML doc
    let xml = XML.createNewDocument({ version: "1.0", encoding: "utf-8" });
    const envelope = XML.createNode("soap:Envelope", {
        "xmlns:soap": "http://schemas.xmlsoap.org/soap/envelope/",
        //"soap12:encodingStyle": "http://www.w3.org/2003/05/soap-encoding/"
    })
    //Postavi xml header
    //const header = XML.createNode("soap:Header", {}, null);
    //envelope.appendChild(header);
    //Postavi body
    const body = XML.createNode("soap:Body", {}, null);
    envelope.appendChild(body);
    //Mapiraj parametre iz data
    for (const key in data) {
        console.log(data);
        const node = XML.createNode(key, data[key].attributes, data[key].text);
        body.appendChild(node);
    }
    xml.appendChild(envelope);
    console.log(xml);
    console.log(XML.getTextContent(xml))
    const res = await remoteService.sendRequest(method, url, XML.getTextContent(xml), headers);
    XML.toJson(xml, {});
    console.log(res);
    const xmlString = await res.text();
    console.log(XML.parse(xmlString));

    return await xmlString;

}

export default soapService;