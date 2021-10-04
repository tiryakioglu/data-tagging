//
//  EtiketCevap.swift
//  Ticket App
//
//  Created by Ali Tiryakioğlu on 28.09.2021.
//

import Foundation

class EtiketCevap : Codable {
    var etagid1:Int?
    var tagname1:String?
    var etagid2:Int?
    var tagname2:String?
    var etagid3:Int?
    var tagname3:String?
    var etagid4:Int?
    var tagname4:String?
    var etagid5:Int?
    var tagname5:String?
    var datasetid:String?
    var dataid:Int?
    var edatarow:Int?
    var veri:String?
    var dataset_type:Int?
    init(etagid1:Int,tagname1:String,etagid2:Int,tagname2:String,etagid3:Int,tagname3:String,etagid4:Int,tagname4:String,etagid5:Int,tagname5:String,datasetid:String,dataid:Int,edatarow:Int,veri:String,dataset_type:Int) {
        self.etagid1 = etagid1
        self.tagname1 = tagname1
        self.etagid2 = etagid2
        self.tagname2 = tagname2
        self.etagid3 = etagid3
        self.tagname3 = tagname3
        self.etagid4 = etagid4
        self.tagname4 = tagname4
        self.etagid5 = etagid5
        self.tagname5 = tagname5
        self.datasetid = datasetid
        self.dataid = dataid
        self.edatarow = edatarow
        self.dataset_type = dataset_type
        self.veri = veri
    }
}
