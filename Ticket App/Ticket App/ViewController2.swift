//
//  ViewController2.swift
//  Ticket App
//
//  Created by Ali Tiryakioğlu on 27.09.2021.
//

import UIKit

class ViewController2: UIViewController {

    @IBOutlet weak var verisetTableView: UITableView!
    
    var datasetsListe = [Datasets]()
    override func viewDidLoad() {
        super.viewDidLoad()

        verisetTableView.delegate = self
        verisetTableView.dataSource = self
    }
    
    override func viewWillAppear(_ animated: Bool) {
        tumDsAl()
    }
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        
    }
    
    func tumDsAl() {
    let globusername = globalDegiskenler.username
    let globpassword = globalDegiskenler.password
        let url = URL(string: "http://192.168.1.45/staj/indexresponse.php?page=dataset&process=1&username=\(globusername)&password=\(globpassword)")!
        URLSession.shared.dataTask(with: url){ data,response,error in
            if error != nil || data == nil {
                print("Hata")
                return
            }
            do{
               let cevap = try JSONDecoder().decode(DatasetsCevap.self, from: data!)
                if let gelenDatasetListesi = cevap.Datasets {
                   self.datasetsListe = gelenDatasetListesi
                }
                
                DispatchQueue.main.async {
                  self.verisetTableView.reloadData()
                }
                }catch{
                
                print(String(describing: error)) 
                //print(error.localizedDescription)
            }
        }.resume()
    }

    

}

extension ViewController2:UITableViewDataSource,UITableViewDelegate{
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return datasetsListe.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let dataset = datasetsListe[indexPath.row]
        let cell = tableView.dequeueReusableCell(withIdentifier: "verisetiHucre", for: indexPath) as! DatasetHucreTableViewCell
        cell.labelVSID.text = dataset.dataset_id
        cell.labelVSAdi.text = dataset.name
        return cell
    }
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        globalDegiskenler.datasetid = datasetsListe[indexPath.row].dataset_id!
        self.performSegue(withIdentifier: "toDsDetay", sender: indexPath.row)
    }
}
