//
//  ViewController.swift
//  Ticket App
//
//  Created by Ali Tiryakioğlu on 26.09.2021.
//

import UIKit

class ViewController: UIViewController {

    @IBAction func girisyap(_ sender: Any) {
        var request = URLRequest(url: URL(string: "http://192.168.1.45/staj/girisurl.php")!)
        request.httpMethod = "POST"
        let postString = "username=\(username.text!)&password=\(userpassword.text!)"
        request.httpBody = postString.data(using: .utf8)
        URLSession.shared.dataTask(with: request){ (data, response, error) in
            if error != nil || data == nil {
                print("Hata")
                return
            }
            do{
                
                    let sonuc = try! JSONDecoder().decode(login.self, from: data!)
                if sonuc.success == 1 {
                    globalDegiskenler.username = self.username.text!
                    globalDegiskenler.password = self.userpassword.text!
                    DispatchQueue.main.async {
                    //sayfa2ye gec
                    let storyboard = UIStoryboard(name: "Main", bundle: nil)
                    let gidilecekviewcontroller = storyboard.instantiateViewController(withIdentifier: "sayfa2") as! ViewController2
                        
                        gidilecekviewcontroller.modalPresentationStyle = .fullScreen
                        gidilecekviewcontroller.modalTransitionStyle = .crossDissolve
                        
                    self.present(gidilecekviewcontroller, animated: true, completion: nil)
                        
                    }                }else{
                        DispatchQueue.main.async {
                        //login basarisiz
                        // Create new Alert
                        let dialogMessage = UIAlertController(title: "Hata", message: "Bilgileriniz Yanlış!", preferredStyle: .alert)
                         
                         // Create OK button with action handler
                         let ok = UIAlertAction(title: "Tamam", style: .default, handler: { (action) -> Void in
                             print("Ok button tapped")
                          })
                         
                         //Add OK button to a dialog message
                         dialogMessage.addAction(ok)
                         // Present Alert to
                            self.present(dialogMessage, animated: true, completion: nil)}
                    }
                
            }catch{
                print("JSON error: \(error.localizedDescription)")
            }
        }.resume()
    }
    @IBOutlet weak var username: UITextField!
    
    @IBOutlet weak var userpassword: UITextField!
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view.
    }
    
}

