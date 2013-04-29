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
using System.Web;

namespace gru_lokaverk
{
    /// <summary>
    /// Interaction logic for tab3.xaml
    /// </summary>
    public partial class tab3 : UserControl
    {
        sql database = new sql(); //SQL Database
        classes_edit editWin; //Edit class window
        new_Class New_ClassWindow; //New Class window
        DeleteForm deleteWindow; //Delete window

        List<string> getRooms; //List for Classes
        string SendingFrom = "rooms";


        public tab3()
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
            try
            {
                ShowClasses();
            }
            catch (Exception e)
            {
                MessageBox.Show(e.ToString());
            }
        }

        private void ShowClasses()
        {
            getRooms = new List<string>();
            List<Classes> lst = new List<Classes>();
            Classes sr = new Classes();
            try
            {
                getRooms = database.getRooms();
                string[] tempArray = new string[4];
                char split = ';';
                foreach (string item in getRooms)
                {
                    tempArray = item.Split(split);
                    sr.id = tempArray[0];
                    sr.name = tempArray[1];
                    sr.description = tempArray[3];
                    sr.Marks = tempArray[1] + " - " + tempArray[3];
                    sr.delBtn = sr.name;

                    lst.Add(sr);
                    sr = new Classes();
                }
                MyPanel.DataContext = lst;

            }
            catch (Exception e)
            {
                MessageBox.Show(e.ToString());
            }

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

        //On double click event to add edit the class that was double clicked
        private void ClassesView_MouseDoubleClick(object sender, MouseButtonEventArgs e)
        {
            var item = ((FrameworkElement)e.OriginalSource).DataContext as Track;
            if (item == null)
            {
                // Opens classes_edit.xaml
                if (ClassesView.SelectedIndex != -1)
                {
                    Classes valueSelected = (Classes)ClassesView.SelectedItems[0];

                    if (editWin != null)
                        editWin.Close();

                    editWin = new classes_edit(getRooms, valueSelected.id.ToString(),SendingFrom);//Sends the list and the ID of the value selected
                    editWin.closeWindow.Click += new RoutedEventHandler(closeWindow_Click);
                    editWin.UpdateList.Click += new RoutedEventHandler(UpdateList_Click);
                    editWin.Owner = Window.GetWindow(this);
                    editWin.ShowDialog();
                }
            }
        }

        void closeWindow_Click(object sender, RoutedEventArgs e)
        {
            if (editWin != null)
                editWin.Close();
            editWin = null;

            if (New_ClassWindow != null)
                New_ClassWindow.Close();
            New_ClassWindow = null;

            if (deleteWindow != null)
                deleteWindow = null;
            ShowClasses();//Refreshes the classes
        }

        void UpdateList_Click(object sender, RoutedEventArgs e)
        {
            ShowClasses();
        }

        private void btn_Add_Click(object sender, RoutedEventArgs e)
        {
            if (New_ClassWindow != null)
                New_ClassWindow.Close();
            New_ClassWindow = new new_Class(SendingFrom);
            New_ClassWindow.closeWindow.Click += new RoutedEventHandler(closeWindow_Click);
            New_ClassWindow.UpdateList.Click += new RoutedEventHandler(UpdateList_Click);
            New_ClassWindow.Owner = Window.GetWindow(this);
            New_ClassWindow.ShowDialog();


        }
        //Del Button
        private void del_btn_Click(object sender, RoutedEventArgs e)
        {
            string nameToDelete = ((Button)sender).Tag.ToString();

            deleteWindow = new DeleteForm(nameToDelete,SendingFrom);
            deleteWindow.closeWindow.Click += new RoutedEventHandler(closeWindow_Click);
            deleteWindow.UpdateList.Click += new RoutedEventHandler(UpdateList_Click);
            deleteWindow.Owner = Window.GetWindow(this);
            deleteWindow.ShowDialog();



        }

    }
}
