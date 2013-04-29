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
    /// Interaction logic for new_Class.xaml
    /// </summary>
    public partial class new_Class : Window
    {
        sql database = new sql();

        string infoSentFrom = null;
        List<string> RoomTypes;
        string[] RoomsDescription_Array = new string[2];

        public new_Class(string infoSent)
        {
            database.ConnectToDatabase();
            InitializeComponent();
            infoSentFrom = infoSent;

            if (infoSentFrom == "rooms")
            {
                comboBox_types.Visibility = Visibility.Visible;
                txtbox_Descr.Visibility = Visibility.Hidden;

                RoomTypes = new List<string>();
                RoomTypes = database.getAlldata("types");

                string[] tempArray = new string[2];
                char split = ';';
                foreach (string item in RoomTypes)
                {
                    tempArray = item.Split(split);
                    comboBox_types.Items.Add(tempArray[1]);

                }
                comboBox_types.Items.Insert(0," -- Please Select -- ");
                comboBox_types.SelectedIndex = 0;
            }
            else
            {
                comboBox_types.Visibility = Visibility.Hidden;
                txtbox_Descr.Visibility = Visibility.Visible;
            }
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
            get { return this.btn_save; }
        }

        private void btn_save_Click(object sender, RoutedEventArgs e)
        {
            try
            {
                if (infoSentFrom == "classes")
                    database.InsertInto("classes", "name", "description", txtbox_Name.Text, txtbox_Descr.Text);
                else if (comboBox_types.SelectedIndex != 0 && infoSentFrom == "rooms")
                {
                    //To get the type ID from the Combobox
                    string typeID = null;
                    RoomsDescription_Array = null;
                    foreach (string type in RoomTypes)
                    {
                        RoomsDescription_Array = type.Split(';');
                        if (RoomsDescription_Array[1] == comboBox_types.SelectedValue.ToString())
                            typeID = RoomsDescription_Array[0];
                    }
                    database.InsertInto("rooms", "number", "type", txtbox_Name.Text, typeID);
                }
                else
                    return;

            }
            catch (Exception)
            {

            }
            this.Close();

        }
    }
}
