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
using System.Windows.Navigation;
using System.Windows.Shapes;
using System.Windows.Controls.Primitives;
using MySql.Data.MySqlClient;

namespace gru_lokaverk
{
    /// <summary>
    /// Interaction logic for tab2.xaml
    /// </summary>
    public partial class tab2 : UserControl
    {
        sql database = new sql();
        classes_edit editWin = new classes_edit();

        public tab2()
        {
            try
            {
                database.ConnectToDatabase();
            }
            catch (Exception e)
            {
                MessageBox.Show(e.ToString());
            }
            InitializeComponent();
            ShowClasses();
        }

        private void ShowClasses()
        {
            List<string> getClasses = new List<string>();
            List<Classes> lst = new List<Classes>();
            Classes sd = new Classes();

            getClasses = database.getClasses();
            string[] tempArray = new string[2];
            char split = ';';
            foreach (string item in getClasses)
            {
                tempArray = item.Split(split);
                sd.name = tempArray[0];
                sd.description = tempArray[1];
                sd.Marks = tempArray[0] + " - " + tempArray[1];
                lst.Add(sd);
                sd = new Classes();
            }
            MyPanel.DataContext = lst;
        }

        private void Show_PopupToolTip(object sender, MouseEventArgs e)
        {
            ListViewItem listViewItem = e.Source as ListViewItem;
            Classes Student = listViewItem.Content as Classes;
            PopupTextBlock.Text = Student.Marks;
            MyToolTip.PlacementTarget = listViewItem;
            MyToolTip.Placement = PlacementMode.MousePoint;
            MyToolTip.IsOpen = true;
        }
        private void Hide_PopupToolTip(object sender, MouseEventArgs e)
        {
            MyToolTip.IsOpen = false;
        }

        private void ClassesView_MouseDoubleClick(object sender, MouseButtonEventArgs e)
        {
            var item = ((FrameworkElement)e.OriginalSource).DataContext as Track;
            if (item ==null)
            {
                
                editWin.ShowDialog();
            }
        }


    }

    public class Classes
    {
        private string _name;
        public string name
        {
            get { return _name; }
            set { _name = value; }
        }

        private string _marks;
        public string Marks
        {
            get { return _marks; }
            set { _marks = value; }
        }
        private string _description;
        public string description
        {
            get { return _description; }
            set { _description = value; }
        }
    }
}
