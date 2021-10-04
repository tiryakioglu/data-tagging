//
//  Datasets.swift
//  Ticket App
//
//  Created by Ali Tiryakioğlu on 27.09.2021.
//

import Foundation

class Datasets:Codable {
    var dataset_id:String?
    var name:String?
    var start_date:String?
    var end_date:String?
    
    init() {
    }
    
    init(dataset_id:String,name:String,start_date:String,end_date:String) {
        self.dataset_id = dataset_id
        self.name = name
        self.start_date = start_date
        self.end_date = end_date
    }
    
}
