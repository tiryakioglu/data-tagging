//
//  DatasetHucreTableViewCell.swift
//  Ticket App
//
//  Created by Ali Tiryakioğlu on 27.09.2021.
//

import UIKit

class DatasetHucreTableViewCell: UITableViewCell {

    @IBOutlet weak var labelVSID: UILabel!
    @IBOutlet weak var labelVSAdi: UILabel!
    
    
    override func awakeFromNib() {
        super.awakeFromNib()
        // Initialization code
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}
