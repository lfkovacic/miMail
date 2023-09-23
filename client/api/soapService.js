import ajaxService from "./ajaxService";
import { XML } from "../util/XML";

const soapService = {};

soapService.sendReqest() = function (method, url, data, headers) {

    //Instanciraj novi XML doc
    let xml = XML.createNewDocument({ version: "1.0", encoding: "utf-8" });
    const envelope = XML.createNode("soap:Envelope", {
        "xmlns:soap": "http://www.w3.org/2003/05/soap-envelope/",
        "soap:encodingStyle": "http://www.w3.org/2003/05/soap-encoding/"
    })
    //Postavi xml header
    const header = XML.createNode("soap:Header", {}, null);
    envelope.appendChild(header);
    //Postavi body
    const body = XML.createNode("soap:Body", {}, null);
    envelope.appendChild(body);
    //Mapiraj parametre iz data
    for (const key in data) {
        const node = XML.createNode(key, null, data[key]);
        body.appendChild(node);
    }
    xml.appendChild(envelope);

    ajaxService.sendRequest(method, url, XML.getTextContent(xml), headers);

}