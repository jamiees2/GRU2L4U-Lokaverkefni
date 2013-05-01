using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;
using MySql.Data.MySqlClient;

namespace gru_lokaverk
{
    /// <summary>
    /// Interaction logic for DeleteForm.xaml
    /// </summary>
    public partial class DeleteForm : Window
    {
        string nameToDelete = null, infoSentFrom=null;
        sql database = new sql();

        public DeleteForm(string name, string infoSent)
        {
            database.ConnectToDatabase();
            InitializeComponent();
            nameToDelete = name;
            infoSentFrom = infoSent;

            if (infoSentFrom == "classes")
                label1.Content = string.Format("Are you sure you want to\npermanently delete class {0} ?", nameToDelete);
            else if (infoSentFrom == "rooms")
                label1.Content = string.Format("Are you sure you want to\npermanently delete room {0} ?", nameToDelete);
        }

        private void btn_Close_Click(object sender, RoutedEventArgs e)
        {
            this.Close();
        }
        public Button closeWindow
        {
            get { return this.btn_Close; }
        }
        public Button UpdateList
        {
            get { return this.btn_delete; }
        }

        private void btn_delete_Click(object sender, RoutedEventArgs e)
        {
            try
            {
                if (infoSentFrom == "classes")
                    database.deleteData("classes", "name", nameToDelete);
                else if (infoSentFrom == "rooms")
                    database.deleteData("rooms", "number", nameToDelete);
            }
            catch (Exception)
            {
                MessageBox.Show("Ekki er hægt að eyða gögnum. Eru í notkun annarsstaðar.");
            }
            
            this.Close();
        }
    }
}
