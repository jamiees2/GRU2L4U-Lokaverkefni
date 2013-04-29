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
    /// Interaction logic for Edit_Schedule.xaml
    /// </summary>
    public partial class Edit_Schedule : Window
    {
        sql database = new sql();

        List<string> ClassSchedule; // Ekki í notkun atm
        List<string> allClasses;
        string[] tempSplitArray;
        int SelectedBox, timePeriods_ID, day_id;
        string ButtonContent;

        public Edit_Schedule(List<string> classesSchedule, string boxSelected, string btnContent)
        {
            database.ConnectToDatabase();

            InitializeComponent();
            ClassSchedule = classesSchedule;
            SelectedBox = Convert.ToInt32(boxSelected);
            ButtonContent = (btnContent);
            FillComboBox();
        }

        private void btn_Close_Click(object sender, RoutedEventArgs e)
        {
            this.Close();
        }
        private void btn_save_Click(object sender, RoutedEventArgs e)
        {
            if (validClass())
            {
                // Select skipun.
                this.Close();
            }

        }
        public Button closeWindow
        {
            get { return this.btn_Close; }
        }
        public Button UpdateList
        {
            get { return this.btn_save; }
        }

        private void FillComboBox()
        {
             tempSplitArray = new string[4];
            allClasses = database.getAlldata("classes");

            foreach (var item in allClasses)
            {
                tempSplitArray = item.Split(';');


                if (tempSplitArray[1]==ButtonContent)
                {
                    comboBox_classes.Items.Insert(0, ButtonContent);
                    comboBox_classes.SelectedIndex = 0;
                }
                else
                    comboBox_classes.Items.Add(tempSplitArray[1]);
            }
            if (comboBox_classes.SelectedIndex!=0)
            {
                    comboBox_classes.Items.Insert(0, ButtonContent);
                    comboBox_classes.SelectedIndex = 0;
            }
        }

        private bool validClass()
        {
            tempSplitArray = new string[4];
            foreach (var item in allClasses)
            {
                tempSplitArray = item.Split(';');
                if (tempSplitArray[1] == comboBox_classes.SelectedValue.ToString())
                    return true;
            }
            return false;
        }
        private void Position()
        {

            if (SelectedBox > 16 && SelectedBox < 32)//Monday
            {
                timePeriods_ID = SelectedBox - 16;
                day_id = 1;
            }
            else if (SelectedBox > 32 && SelectedBox < 48)//Tuesday
            {
                timePeriods_ID = SelectedBox - 32;
                day_id = 2;
            }
            else if (SelectedBox > 48 && SelectedBox < 64)//Wednsday
            {
                timePeriods_ID = SelectedBox - 48;
                day_id = 3;
            }
            else if (SelectedBox > 64 && SelectedBox < 80) //Thursday
            {
                timePeriods_ID = SelectedBox - 64;
                day_id = 4;
            }
            else if (SelectedBox > 80 && SelectedBox < 96) //Friday
            {
                timePeriods_ID = SelectedBox - 80;
                day_id = 5;
            }
            else if (SelectedBox > 96 && SelectedBox < 112)//Saturday
            {
                timePeriods_ID = SelectedBox - 96;
                day_id = 6;
            }
            else if (SelectedBox > 112 && SelectedBox < 128) //Sunday
            {
                timePeriods_ID = SelectedBox - 112;
                day_id = 7;
            }

        }
    }
}
