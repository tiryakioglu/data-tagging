//
//  VerisetDetayViewController.swift
//  Ticket App
//
//  Created by Ali Tiryakioğlu on 27.09.2021.
//

import UIKit

class VerisetDetayViewController: UIViewController {
    
    var dataid:Int = 0
    var edatarow:Int = 0
    var etagid1:Int = 0
    var etagid2:Int = 0
    var etagid3:Int = 0
    var etagid4:Int = 0
    var etagid5:Int = 0
    
    

    @IBOutlet weak var imageView: UIImageView!
    @IBOutlet weak var verisetidne: UILabel!
    var mesaj:String?
    
    @IBOutlet weak var textview: UITextView!
    
    @IBOutlet weak var pasbutdegis: UIButton!
    
    @IBOutlet weak var button1degis: UIButton!
    
    @IBOutlet weak var button2degis: UIButton!
    
    @IBOutlet weak var button3degis: UIButton!
    
    @IBOutlet weak var button4degis: UIButton!
    
    @IBOutlet weak var button5degis: UIButton!
    
    @IBAction func pasgec(_ sender: Any) {
        print("pas gec basildi \(dataid)")
        etiketgetir(fdataid: dataid, fedatarow: 0, fetagid: 0)
    }
    
    @IBAction func button1act(_ sender: Any) {
        etiketgetir(fdataid: dataid, fedatarow: edatarow, fetagid: etagid1)
    }
    
    @IBAction func button2act(_ sender: Any) {
        etiketgetir(fdataid: dataid, fedatarow: edatarow, fetagid: etagid2)
    }
    
    @IBAction func button3act(_ sender: Any) {
        etiketgetir(fdataid: dataid, fedatarow: edatarow, fetagid: etagid3)
    }
    
    @IBAction func button4act(_ sender: Any) {
        etiketgetir(fdataid: dataid, fedatarow: edatarow, fetagid: etagid4)
    }
    
    @IBAction func button5act(_ sender: Any) {
        etiketgetir(fdataid: dataid, fedatarow: edatarow, fetagid: etagid5)
    }
    
    
    func etiketgetir(fdataid:Int,fedatarow:Int,fetagid:Int){
        var urldataid:String = " "
        var urledatarow:String = " "
        var urletagid:String = " "
        if fdataid != 0 {
            urldataid = "&dataid=\(fdataid)"
        }
        if fedatarow != 0 {
            urledatarow = "&edatarow=\(fedatarow)"
        }
        if fetagid != 0 {
            urletagid = "&etagid=\(fetagid)"
        }
        
    let globusername = globalDegiskenler.username
    let globpassword = globalDegiskenler.password
    let globdatasetid = globalDegiskenler.datasetid
            var request = URLRequest(url: URL(string: "http://192.168.1.45/staj/indexresponse.php?page=dataset&process=2&datasetid=\(globdatasetid)&username=\(globusername)&password=\(globpassword)")!)
            request.httpMethod = "POST"
            let postString = "\(urldataid)\(urledatarow)\(urletagid)"
            request.httpBody = postString.data(using: .utf8)
            URLSession.shared.dataTask(with: request){ (data, response, error) in
                if error != nil || data == nil {
                    print("Hata")
                    return
                }
                do{
                    
                        let sonuc = try! JSONDecoder().decode(EtiketCevap.self, from: data!)
                    if(sonuc.dataset_type == 2){
                       
                        if let url = URL(string: "http://192.168.1.45/staj/\(sonuc.veri!)") {

                                    DispatchQueue.global().async {
                                        self.textview.isHidden = true
                                        let data  = try? Data(contentsOf: url)

                                        DispatchQueue.main.async {
                                            self.imageView.image = UIImage(data: data!)
                                        }
                                    }

                                }
                    }else{
                        self.imageView.isHidden = true
                        self.textview.isHidden = false
                    }
                    
                    DispatchQueue.main.async {
                    self.textview.text = sonuc.veri!
                        
                        if(sonuc.veri == "" && sonuc.edatarow == 0){
                            self.button1degis.isHidden = true
                            self.button2degis.isHidden = true
                            self.button3degis.isHidden = true
                            self.button4degis.isHidden = true
                            self.button5degis.isHidden = true
                            self.pasbutdegis.isHidden = true
                            self.textview.text = "Etiketlenecek veri kalmadı"
                            return
                           
                        }
                        
                        if(sonuc.etagid1 != 0){
                    self.button1degis.setTitle(sonuc.tagname1, for: .normal)
                            self.etagid1 = sonuc.etagid1!
                            self.button1degis.isHidden = false
                        }else{
                            self.button1degis.isHidden = true
                        }
                        if(sonuc.etagid2 != 0){
                    self.button2degis.setTitle(sonuc.tagname2, for: .normal)
                            self.etagid2 = sonuc.etagid2!
                            self.button2degis.isHidden = false
                        }else{
                            self.button2degis.isHidden = true
                        }
                        if(sonuc.etagid3 != 0){
                    self.button3degis.setTitle(sonuc.tagname3, for: .normal)
                            self.etagid3 = sonuc.etagid3!
                            self.button3degis.isHidden = false
                        }else{
                            self.button3degis.isHidden = true
                        }
                        if(sonuc.etagid4 != 0){
                    self.button4degis.setTitle(sonuc.tagname4, for: .normal)
                            self.etagid4 = sonuc.etagid4!
                            self.button4degis.isHidden = false
                        }else{
                            self.button4degis.isHidden = true
                        }
                        if(sonuc.etagid5 != 0){
                    self.button5degis.setTitle(sonuc.tagname5, for: .normal)
                            self.etagid5 = sonuc.etagid5!
                            self.button5degis.isHidden = false
                        }else{
                            self.button5degis.isHidden = true
                        }
                        if(sonuc.dataid == nil){
                            urldataid = String(1)
                            }
                       
                        if(sonuc.dataid != 0){
                            if(sonuc.dataid == nil){
                            self.dataid = 1
                            }else{
                                self.dataid = sonuc.dataid!
                            }
                            
                        }
                        if(sonuc.edatarow != nil){
                            self.edatarow = sonuc.edatarow!
                        }
                        
                        
                        }
                    
                    
                }catch{
                    print("JSON error: \(error.localizedDescription)")
                }
            }.resume()
    }
    
    @IBAction func geridon(_ sender: Any) {
        
        let storyboard = UIStoryboard(name: "Main", bundle: nil)
        let gidilecekviewcontroller = storyboard.instantiateViewController(withIdentifier: "sayfa2") as! ViewController2
            
            gidilecekviewcontroller.modalPresentationStyle = .fullScreen
            gidilecekviewcontroller.modalTransitionStyle = .crossDissolve
            
        self.present(gidilecekviewcontroller, animated: true, completion: nil)
    }
    override func viewWillAppear(_ animated: Bool) {
        etiketgetir(fdataid: 0, fedatarow: 0, fetagid: 0)
    }
    
    override func viewDidLoad() {
        verisetidne.isHidden = true
        super.viewDidLoad()
        
    }
    

}
