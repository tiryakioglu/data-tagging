//
//  login.swift
//  Ticket App
//
//  Created by Ali Tiryakioğlu on 27.09.2021.
//

import Foundation

class login : Codable {
    var success:Int?
    var message:String?
    init(success:Int,message:String) {
        self.success = success
        self.message = message
    }
}
struct globalDegiskenler {
    static var username = ""
    static var password = ""
    static var datasetid = ""
}
